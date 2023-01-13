<?php

namespace App\Controller\Api\Utils;

class ErrorResponse
{
    private $message;
    private $status;

    public function __construct(String $message = 'error', int $status = 500)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function getResponse(\Cake\Http\Response $response): \Cake\Http\Response
    {
        $body = json_encode(['message' => $this->message, 'status' => $this->status]);
        $response = $response->withStatus($this->status);
        $response = $response->withStringBody($body);
        $response = $response->withType('application/json');
        return $response;
    }
}
