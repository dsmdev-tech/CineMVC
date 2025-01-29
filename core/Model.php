<?php

namespace Core;

class Model{

    protected static function conection () : \PDO
    {
        try {
            $pdo = new \PDO(DSN, USER, PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);;

        } catch (\PDOException $e){
            die("Fallo en la conexión" . $e->getMessage());
        }

        return $pdo;
    }
}