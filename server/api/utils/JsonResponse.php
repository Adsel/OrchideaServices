<?php


class JsonResponse {
    public static function makeResponse(array $responseObject) {
        header('Content-Type: application/json; charset=utf-8');

        return json_encode($responseObject, JSON_UNESCAPED_UNICODE);
    }
}
