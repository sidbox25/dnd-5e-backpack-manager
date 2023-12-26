<?php

namespace src\Core;

use src\Core\Configuration\Database\ConnectionConfig;

class Connector
{

    /**
     * @var \PDO|null
     */
    private static ?PDO $connection = null;

    /**
     * @return \PDO
     */
    public static function getConnection(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $dnsString = self::buildDnsString();
        $username = ConnectionConfig::getDatabaseUser();
        $password = ConnectionConfig::getDatabasePassword();
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
            PDO::ATTR_PERSISTENT => true
        ];

        self::$connection = new PDO($dnsString, $username, $password, $options);

        return self::$connection;
    }

    /**
     * @return string
     */
    private static function buildDnsString(): string
    {
        return sprintf(
            "%s:host=%s;dbname=%s;",
            ConnectionConfig::getDatabaseDriver(),
            ConnectionConfig::getDatabaseHost(),
            ConnectionConfig::getDatabaseName(),
        );
    }
}
