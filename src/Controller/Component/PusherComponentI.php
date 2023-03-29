<?php

namespace App\Controller\Component;


interface PusherComponentI
{
    public function publish($channel, $event, array $data);
 
    public function authenticate($channelName, $socketId);
}
