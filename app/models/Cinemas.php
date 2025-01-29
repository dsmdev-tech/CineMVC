<?php
//Daniel Sanchez Medialdea

namespace App\Models;

use Core\Model;

#[\AllowDynamicProperties]

class Cinemas extends Model
{

    public static function all(){
        $db = self::conection();
        $sql = "SELECT * FROM cinemas";
        $stm = $db->prepare($sql);
        $stm->execute();
        //usar fetchmode para que devuelva un objeto
        $result = $stm->fetchAll(\PDO::FETCH_CLASS, self::class);
        return $result;
    }

    public static function countAll()
    {
        $db = self::conection();
        $sql = "SELECT COUNT(*) as total FROM cinemas";
        $stm = $db->prepare($sql);
        $stm->execute();
        $result = $stm->fetch();
        return $result['total'];
    }


}