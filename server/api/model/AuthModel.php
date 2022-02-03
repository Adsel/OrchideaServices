<?php

class AuthModel
{
    const AUTH_TOKEN_LENGTH = 30;
    const AUTH_TOKEN_EXPIRATION_FORMAT = 'Y-m-d';
    const AUTH_TOKEN_EXPIRATION_DAYS = 3;

    /**
     * Generate auth token string
     *
     * @return string
     * @throws Exception
     */
    public static function generateAuthToken(): string
    {
        return bin2hex(random_bytes(self::AUTH_TOKEN_LENGTH));
    }

    /**
     * Generate expiration auth token date string
     *
     * @return string
     */
    public static function getAuthTokenExpirationDate(): string
    {
        $now = date(self::AUTH_TOKEN_EXPIRATION_FORMAT);

        $expirationString = $now . ' + ' . self:: AUTH_TOKEN_EXPIRATION_DAYS. ' days';
        return date(self::AUTH_TOKEN_EXPIRATION_FORMAT, strtotime($expirationString));
    }

    /**
     * Check if token doesn't expired
     *
     * @param string $expirationDateString
     * @return string
     */
    public static function isAuthTokenValid(string $expirationDateString): string
    {
        $now = date(self::AUTH_TOKEN_EXPIRATION_FORMAT);
        $expirationDate = strtotime($expirationDateString);
        $expiration = date(self::AUTH_TOKEN_EXPIRATION_FORMAT, $expirationDate);

        return $now < $expiration;
    }
}
