<?php


class JsonResponse {

    public static function makeResponse(array $responseObject) {
        Cors::loadCorsHeaders();

        return json_encode($responseObject, JSON_UNESCAPED_UNICODE);
    }
}
