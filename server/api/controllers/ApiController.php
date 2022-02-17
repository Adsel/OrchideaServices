<?php

class ApiController
{
    /** @var $bodyData */
    protected $bodyData;

    /**
     * ApiController constructor
     */
    public function __construct()
    {
        $json = file_get_contents('php://input');
        $this->bodyData = !!$json ? (json_decode($json)->data) : (object)[];
    }
}
