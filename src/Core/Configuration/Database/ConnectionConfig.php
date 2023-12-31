<?php

namespace src\Core\Configuration\Database;

class ConnectionConfig
{
    /**
     * @return string
     */
    public static function getDatabaseUser(): string
    {
        return getenv('MYSQL_USER');
    }

    /**
     * @return string
     */
    public static function getDatabasePassword(): string
    {
        return getenv('MYSQL_PASSWORD');
    }

    /**
     * @return string
     */
    public static function getDatabaseHost(): string
    {
        return getenv('MYSQL_HOST');
    }

    /**
     * @return string
     */
    public static function getDatabaseName(): string
    {
        return getenv('APP_MYSQL_DB_NAME');
    }

    /**
     * @return string
     */
    public static function getDatabaseDriver(): string
    {
        return getenv('APP_MYSQL_DRIVER');
    }
}
