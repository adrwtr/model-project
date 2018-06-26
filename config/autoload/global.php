<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

// use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
use Doctrine\DBAL\Driver\PDOSqlite\Driver as PDO;

$ds_oficial_database_name = 'sql.sqlite';

if (defined('PHPUNIT_CONST')) {
    if (PHPUNIT_CONST == true) {
        $ds_oficial_database_name = 'sql_unittest.sqlite';
    }
}

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDO::class,
                'params' => [
                    'user'     => 'root1',
                    'password' => 'root',
                    'path' => $ds_oficial_database_name,
                    'memory' => false
                ]
            ],
        ],
    ],
];