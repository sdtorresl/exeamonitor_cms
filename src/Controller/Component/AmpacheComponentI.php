<?php

namespace App\Controller\Component;


interface AmpacheComponentI
{
    public function handshake();

    public function getSong($uid);

    public function getSongs(DataParams $params);

    public function getNext();
}
