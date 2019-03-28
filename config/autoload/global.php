<?php
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
// use Doctrine\DBAL\Driver\PDOSqlite\Driver as PDO;

use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

$ds_oficial_database_name = 'sql.sqlite';

if (defined('PHPUNIT_CONST')) {
    if (PHPUNIT_CONST == true) {
        $ds_oficial_database_name = 'sql_unittest.sqlite';
    }
}



return [
    'doctrine' => [

        // conexao sqlite
        /*'connection' => [
            'orm_default' => [
                'driverClass' => PDO::class,
                'params' => [
                    'user'     => 'root1',
                    'password' => 'root',
                    'path' => $ds_oficial_database_name,
                    'memory' => false
                ]
            ],
        ],*/


        // base MYSQL
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' =>     [
                    'host' => 'localhost',
                    'user'     => 'backup',
                    'password' => 'UniSeguro',
                    'dbname' => 'modelproj',
                    'charset' => 'utf8',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8' COLLATE 'utf8_general_ci'"
                    ]
                ]
            ]
        ]
    ],

    // Session configuration.
    'session_config' => [
        // Session cookie will expire in 1 hour.
        'cookie_lifetime' => 60*60*1,
        // Session data will be stored on server maximum for 30 days.
        'gc_maxlifetime'     => 60*60*24*30,
    ],

    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ],
    ],

    // Session storage configuration.
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],


];