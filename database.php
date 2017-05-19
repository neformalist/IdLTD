<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 16.05.17
 * Time: 12:41
 */
class Database {

    private $_connection;
    private static $_instance = NULL;

    private function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=IdLTD";
        $this->_connection = new PDO($dsn, 'root', '123');
        $this->_connection->exec("set names utf8");
    }

    public static function getInstance()
    {
        if(!self::$_instance)  self::$_instance = new self();
        return self::$_instance;
    }

    private function __clone() {}

    private function __wakeup() {}

    public function getConnection()
    {
        return $this->_connection;
    }
}