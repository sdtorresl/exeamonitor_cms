<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Component\DataParams;
use App\Controller\Component\SearchParams;
use App\Controller\Api\Utils\ErrorResponse;
use Cake\Cache\Cache;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

/**
 * Player Controller
 *
 *
 * @method \App\Model\Entity\Check[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayerController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'songs', 'song', 'playlists', 'playlist', 'nextSong', 'search']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $url = env('AMPACHE_HOST', 'ampache') . ':' . env('AMPACHE_PORT', '80');
        $user = env('AMPACHE_USER', 'admin');
        $pass = env('AMPACHE_PASS', 'admin');

        $this->loadComponent('Ampache', [
            'url' => $url,
            'user' => $user,
            'pass' => $pass,
            'type' => 'json'
        ]);

        $this->loadComponent('Pusher', [
            'appKey' => Configure::read('Pusher.appKey'),
            'appSecret' => Configure::read('Pusher.appSecret'),
            'appId' => Configure::read('Pusher.appId'),
            'cluster' => Configure::read('Pusher.cluster')
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->set('data', $this->Ampache->handshake());
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function playlists()
    {
        $this->Authorization->skipAuthorization();
        $this->set('data', $this->Ampache->getPlaylists(new DataParams())->playlist);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function playlist($uid = null)
    {
        $this->Authorization->skipAuthorization();

        $playlist = $this->Ampache->getPlaylist($uid);
        if ($playlist) {
            $this->set('data', $playlist);
            $this->viewBuilder()->setOption('serialize', ['data', 'message']);
        } else {
            $errorResponse = new ErrorResponse('Not found', 404);
            return $errorResponse->getResponse($this->response);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function playlistSongs($uid = null)
    {
        $this->Authorization->skipAuthorization();

        $songs = $this->Ampache->getPlaylistSongs($uid);
        if ($songs) {
            $this->set('data', $songs);
            $this->viewBuilder()->setOption('serialize', ['data', 'message']);
        } else {
            $errorResponse = new ErrorResponse('Not found', 404);
            return $errorResponse->getResponse($this->response);
        }
    }

    /**
     * Get songs method
     *
     * @return \Cake\Http\Response|null
     */
    public function songs()
    {
        $page = $this->request->getQuery('page', 0);
        $limit = $this->request->getQuery('limit', 25);
        $offset = $limit * $page;
        $this->set('data', $this->Ampache->getSongs(new DataParams($offset, $limit))->song);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Search songs method
     *
     * @return \Cake\Http\Response|null
     */
    public function search()
    {
        $query = $this->request->getQuery('query', '');
        $random = $this->request->getQuery('random', false);
        $page = $this->request->getQuery('page', 0);
        $limit = $this->request->getQuery('limit', 25);
        $offset = $limit * $page;

        $rules = [['title', 2, $query], ['artist', 2, $query], ['artist', 0, $query], ['title', 0, $query], ['album', 0, $query], ['albumartist', 2, $query], ['albumartist', 0, $query], ['genre', 6, $query]];

        $searchParams = new SearchParams($rules, 'or', 'song', $offset, $limit, $random);
        $this->set('data', $this->Ampache->search($searchParams)->song);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Get song method
     *
     * @return \Cake\Http\Response|null
     */
    public function song($uid = null)
    {
        $this->Authorization->skipAuthorization();

        $song = $this->Ampache->getSong($uid);
        if ($song) {
            $this->set('data', $song);
            $this->viewBuilder()->setOption('serialize', ['data', 'message']);
        } else {
            $errorResponse = new ErrorResponse('Not found', 404);
            return $errorResponse->getResponse($this->response);
        }
    }

    /**
     * Get song method
     *
     * @return \Cake\Http\Response|null
     */
    public function nextSong($posId = null)
    {
        // TODO cambio zona horaria.
        date_default_timezone_set('America/Bogota');
        $this->Authorization->skipAuthorization();

        // Get from cache if exists
        $cached = $this->request->getQuery('cached', true);
        $lastSong = Cache::read('last-song-' . $posId, 'short');
        $last_song_time = $lastSong->time ?? 180;
        $last_song_time_negative = -1 * abs($last_song_time);
        $ruleHour = $lastSong->ruleHour ?? FALSE;
        if ($lastSong != null && $cached === true) {
            Log::write('debug', "Loaded song from cache for POS $posId");
            $this->set('song', $lastSong);
            $this->viewBuilder()->setOption('serialize', 'song');
            return;
        }
        Log::write('debug', "Next song for POS $posId is not cached, getting from DB...");

        $query = $this->getTableLocator()->get('PointsOfSale')->find()
            ->where(['PointsOfSale.id' => $posId])
            ->contain(['Playbooks', 'Playbooks.Rules'])
            ->contain('SongsRequests', function ($q) {
                return $q
                    ->where(['SongsRequests.played' => false])
                    ->order(['SongsRequests.created' => 'ASC']);
            });
        $pos = $query->first();
        $now = FrozenTime::now();
        $now = $now->format('H:i:s');
        $day = date('l');
        $now = strtotime($now);
        $flag_rule = FALSE;
        $rule = FALSE;
        if (isset($pos->playbook->rules) && !$ruleHour) {
            foreach ($pos->playbook->rules as $key => &$rul) {
                if ($rul->logic === 'date') {
                    if ($rul->days && $rul->start_hour && $rul->final_hour) {
                        $days = explode(',', $rul->days);
                        $start_hour = strtotime($rul->start_hour);
                        $final_hour = strtotime($rul->final_hour);
                        if (in_array($day, $days) && $start_hour <= $now && $final_hour >= $now) {
                            $flag_rule = TRUE;
                            $rule = $rul;
                            break;
                        }
                    }
                    unset($pos->playbook->rules[$key]);
                }
            }

        }
        $song = null;
        if ($flag_rule) {
            $song = $this->getFromRuleHour($rule);
        }
        elseif ($pos->songs_requests != null && count($pos->songs_requests) > 0) {
            $song = $this->getFromRequest($pos);
        } else {
            $song = $this->getFromRule($pos);
        }
        Cache::write('last-song-' . $posId, $song, 'short');

        $this->set('song', $song);
        $this->viewBuilder()->setOption('serialize', 'song');
    }

    private function getFromRuleHour($rule) {
        $playlistId = (string) $rule->tag;
        $songs = $this->Ampache->getPlaylistSongs($playlistId);
        $song = $songs[array_rand($songs)];
        $song->ruleHour = $rule->once ?? FALSE;
        return $song;
    }

    private function getFromRule($pos)
    {
        $posId = $pos->id;

        try {
            if ($pos->playbook == null || count($pos->playbook->rules) == 0) {
                throw new \Exception("Sin reglas", 1);
            }
            $lastRule = Cache::read('last-rule-' . $posId, 'long') ?? -1;
            $nextRule = $lastRule + 1;
            $nextRule = $nextRule < count($pos->playbook->rules) ? $nextRule : 0;
            $currentRule = $pos->playbook->rules[$nextRule];

            Log::write('notice', "Last rule played for POS $posId is $nextRule");
            Cache::write('last-rule-' . $posId, $nextRule, 'long');

            $playlistId = (string) $currentRule->tag;
            $songs = $this->Ampache->getPlaylistSongs($playlistId);
            $song = $songs[array_rand($songs)];
        }
        catch (\Exception $e) {
            Log::write('notice', "No rules asociated for POS $posId, returning random song");
            $songs = $this->Ampache->getSongs(new DataParams())->song;
            $song = $songs[array_rand($songs)];
        }

        return $song;
    }

    private function getFromRequest($pos)
    {
        Log::write('notice', "POS $pos->id has a song request");

        $songRequestsTable = $this->getTableLocator()->get('SongsRequests');
        $songRequest = $songRequestsTable->get($pos->songs_requests[0]->id);
        $songRequest->played = true;
        $songRequestsTable->save($songRequest);

        /* Notify listeners */
        $this->Pusher->publish("pos-{$songRequest->pos_id}", 'request-played', $songRequest->toArray());

        $song = $this->Ampache->getSong($pos->songs_requests[0]->song_id);
        return $song;
    }
}
