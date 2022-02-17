<?php

class Cors
{

    /**
     * Resolve CORS errors
     *
     * @return void
     */
    public static function loadCorsHeaders(): void {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Token');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
        header('Content-Type: application/json; charset=utf-8');
    }
}
