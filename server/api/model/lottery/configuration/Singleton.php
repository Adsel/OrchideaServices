<?php

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class Singleton
{
    private static Configuration $configurationInstance;

    /**
     * Singleton constructor.
     */
    protected function __construct() {}

    /**
     * Return singleton instance for
     *
     * @return Configuration
     */
    public static function getConfiguration(): Configuration
    {
        if (!isset(self::$configurationInstance)) {
            self::$configurationInstance = new Configuration();
        }

        return self::$configurationInstance;
    }
}
