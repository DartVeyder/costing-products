<?php

use Josantonius\Database\Database;

class DatabaseConnection
{
    private static $connection = null;

    private function __construct() {}
    public static function getInstance()
    {
          // перевірка чи з'єднання з базою даних вже існує
        if (!isset(self::$connection)) {
             // завантаження файлу конфігурацій
            require_once('config/database.php');

            // підключення до бази даних
            self::$connection =  Database::getConnection(
                '1',  # Unique identifier
                'PDOprovider', # Database provider name
                DB_HOST,   # Database server
                DB_USERNAME,     # Database user
                DB_NAME,     # Database name
                DB_PASSWORD,    # Database password
                array('charset' => 'utf8')
            );
        }
        return self::$connection;
    }
}
