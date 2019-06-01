<?php
namespace AppliSynth\Core;

use \PDO;

class Database {

    private $host;
    private $name;
    private $user;
    private $password;

    private $pdo;

    private static $_instance;

    /**
     * Singleton
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new Database('juniorentreprise');
        }
        return self::$_instance;
    }

    public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_password = '') {
        $this->host = $db_host;
        $this->name = $db_name;
        $this->user = $db_user;
        $this->password = $db_password;
    }

    public function getPDO() {
        if (is_null($this->pdo)) {
            $pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name . ';charset=UTF8', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='fr_FR'"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

}