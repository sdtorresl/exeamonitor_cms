<?php

namespace App\Controller\Component;


interface AmpacheComponentI
{
    public function handshake();

    public function getSong($uid);
    public function getPlaylist($uid);

    public function getSongs(DataParams $params);
    public function getPlaylists(DataParams $params);

    public function search(SearchParams $params);

    public function getNext();
}
