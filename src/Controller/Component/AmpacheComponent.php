<?php

namespace App\Controller\Component;

use Cake\Http\Client;
use Cake\Controller\Component;
use Cake\Log\Log;

class AmpacheComponent extends Component implements AmpacheComponentI
{
    public $url;
    public $user;
    public $pass;
    private $type;
    private $apiAuth;

    private $httpClient;

    public function initialize(array $config): void
    {
        $this->url = $config['url'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->type = $config['type'];
        $this->httpClient = new Client(['timeout' => 5]);
    }

    public function setType(String $type)
    {
        if (strtolower($type) == 'xml' || strtolower($type) == 'json') {
            $this->type = strtolower($type);
        } else throw new \Exception("Type not supported");
    }

    private function getContent(String $response)
    {
        if ($this->type == 'json') {
            return json_decode($response);
        } else if ($this->type == 'xml') {
            return simplexml_load_string($response, null, LIBXML_NOCDATA);
        }

        throw new \Exception("Unsupported type");
    }

    private function getEndpoint(): String
    {
        Log::write('debug', $this->url);

        return join('/', [$this->url, 'server', $this->type . '.server.php']);
    }

    public function handshake()
    {
        $time = time();
        $key = hash('sha256', $this->pass);
        $passphrase = hash('sha256', $time . $key);

        // Log::write('debug', "Ampache handshake intialized");
        $response = $this->httpClient->get($this->getEndpoint(), [
            'action' => 'handshake',
            'auth' => $passphrase,
            'timestamp' => $time,
            'version' => '5.0.0',
            'user' => $this->user
        ]);
        // Log::write('debug', "Ampache handshake response: {$response->getStringBody()}");

        $content = $this->getContent($response->getStringBody());
        $this->apiAuth = (string) $content->auth;

        return $content;
    }

    private function sendCommand($action, $options = [])
    {
        if ($this->apiAuth == null) {
            $this->handshake();
        }

        $options['action'] = $action;
        $options['auth'] = $this->apiAuth;
//        Log::write('debug', "Ampache options: " . implode(',', $options));

        $response = $this->httpClient->get($this->getEndpoint(), $options);
        // Log::write('debug', "Ampache response: {$response->getStringBody()}");

        return $this->getContent($response->getStringBody());
    }

    public function getSong($uid)
    {
        $response = $this->sendCommand('song', ['filter' => $uid]);
        if (property_exists($response, 'song')) {
            return $response->playlist;
        } else if (!property_exists($response, 'error'))
            return $response;

        return null;
    }

    public function getSongs(DataParams $dataParams)
    {
        return $this->sendCommand('songs', $dataParams->getParams());
    }

    public function getPlaylists(DataParams $dataParams)
    {
        return $this->sendCommand('playlists', $dataParams->getParams());
    }

    public function search(SearchParams $searchParams)
    {
        return $this->sendCommand('advanced_search', $searchParams->getParams());
    }

    public function getPlaylistSongs($uid)
    {
        $response = $this->sendCommand('playlist_songs', ['filter' => $uid]);
        if (property_exists($response, 'song')) {
            return $response->song;
        } else if (!property_exists($response, 'error'))
            return $response;

    }

    public function getPlaylist($uid)
    {
        $response = $this->sendCommand('playlist', ['filter' => $uid]);
        if (property_exists($response, 'playlist')) {
            return $response->playlist;
        } else if (!property_exists($response, 'error'))
            return $response;

        return null;
    }

    public function getNext()
    {
    }
}
