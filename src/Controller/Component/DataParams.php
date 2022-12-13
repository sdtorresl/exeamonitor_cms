<?php

namespace App\Controller\Component;

class DataParams
{
    protected $offset;
    protected $limit;

    public function __construct($offset = 0, $limit = 50)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function getParams()
    {
        return [
            'offset' =>  $this->offset,
            'limit' => $this->limit
        ];
    }
}
