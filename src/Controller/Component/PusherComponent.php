<?php

namespace App\Controller\Component;

use Pusher\Pusher;
use Cake\Controller\Component;
use Cake\Log\Log;

class PusherComponent extends Component implements PusherComponentI
{
    public $pusher;


    public function initialize(array $config): void
    {
        $appKey = $config['appKey'];
        $appSecret = $config['appSecret'];
        $appId = $config['appId'];
        $cluster = $config['cluster'];
        
        $this->pusher = new Pusher($appKey, $appSecret, $appId, ['cluster' => $cluster]);
    }

    public function publish($channel, $event, array $data)
    {
        return $this->pusher->trigger($channel, $event, $data);
    }
 
    public function authenticate($channelName, $socketId)
    {
        return $this->pusher->socket_auth($channelName, $socketId);
    }
   
}
