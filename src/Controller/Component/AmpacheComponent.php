<?php

namespace App\Controller\Component;

use Cake\Http\Client;
use Cake\Controller\Component;

class AmpacheComponent extends Component implements AmpacheComponentI
{
    private static ?AmpacheComponentI $instance = null;
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
        $this->httpClient = new Client();
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
        return join('/', [$this->url, 'server', $this->type . '.server.php']);
    }

    public function handshake()
    {
        $time = time();
        $key = hash('sha256', $this->pass);
        $passphrase = hash('sha256', $time . $key);

        $response = $this->httpClient->get($this->getEndpoint(), [
            'action' => 'handshake',
            'auth' => $passphrase,
            'timestamp' => $time,
            'version' => '5.0.0',
            'user' => $this->user
        ]);

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

        $response = $this->httpClient->get($this->getEndpoint(), $options);
        return $this->getContent($response->getStringBody());
    }

    public function getSong($uid)
    {
        return $this->sendCommand('song', ['filter' => $uid])->song;
    }

    public function getSongs(DataParams $dataParams)
    {
        return $this->sendCommand('songs', $dataParams->getParams());
    }

    public function getNext()
    {
    }
}
