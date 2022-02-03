<?php

class ApiController
{
    /** @var object $bodyData */
    protected $bodyData;

    /**
     * ApiController constructor
     */
    public function __construct()
    {
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Token');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');

        $json = file_get_contents('php://input');
        $this->bodyData = !!$json ? (json_decode($json)->data) : (object)[];
    }
}
