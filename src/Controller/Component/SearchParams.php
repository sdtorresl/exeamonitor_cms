<?php

namespace App\Controller\Component;

class SearchParams extends DataParams
{
    protected $operator;
    protected $rules;
    protected $type;
    protected $random;


    public function __construct($rules, $operator = 'or', $type='song', $offset = 0, $limit = 50, $random = false)
    {
        $this->rules = $rules;
        $this->operator = $operator;
        $this->type = $type;
        $this->random = $random;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function getParams()
    {
        $params = [
            'random' =>  $this->random ? 1 : 0,
            'type' =>  $this->type,
            'operator' =>  $this->operator,
            'offset' =>  $this->offset,
            'limit' => $this->limit
        ];

        for ($i=0; $i < count($this->rules); $i++) { 
            $index = $i + 1;
            $params["rule_{$index}"] = $this->rules[$i][0];
            $params["rule_{$index}_operator"] = $this->rules[$i][1];
            $params["rule_{$index}_input"] = $this->rules[$i][2];

        }

        return $params;
    }
}
