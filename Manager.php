<?php
namespace App\Controller;

class Manager {

    public function dbConnect() {
        require_once 'Database.php';
        $db = Database::getInstance();
        $req = $db->getPDO();
        return $req;
    }

}