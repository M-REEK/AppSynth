<?php
namespace AppliSynth\Core;

class Manager {

    public function dbConnect() {
        $db = Database::getInstance();
        $req = $db->getPDO();
        return $req;
    }

}