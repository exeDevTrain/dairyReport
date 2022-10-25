<?php

declare(strict_types=1);

namespace App\DailyReports\Config;

use PDO;


class Connection {

    protected readonly PDO $pdo;

    public function __construct() {

        define('DB_DSN', 'mysql:dbname=php_local;host=db;charset=utf8');

        define('DB_USER', 'phper');

        define('DB_PASSWORD', 'secret');

        define('OPTIONS', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);

        try {
            $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, OPTIONS);
            
        } catch (PDOException $e) {
            echo "接続失敗: " . $e->getMessage() . "\n";
            exit();
        }
    }
}