<?php
//Daniel Sanchez Medialdea

namespace App\Models;

use Core\Model;
use PDO;

#[\AllowDynamicProperties]

class Customer extends Model
{
    public int $idCustomer;
    public string $name;
    public string $surname;
    public string $dateOfBirth;
    public string $email;
    public string $password;


    public static function findByEmail($email)
    {
        $db = self::conection();
        $sql = "SELECT * FROM customers WHERE email = :email";

        $stm = $db->prepare($sql);
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->execute();

        return $stm->fetch();
    }

    public static function existsLogin($email , $password)
    {
        $db = self::conection();
        $sql = "SELECT idCustomer FROM customers WHERE email = :email AND password = :password";
        $stm = $db->prepare($sql);
        $stm->bindParam(":email" , $email);
        $stm->bindParam(":password", $password);
        $stm->execute();
        return $stm->fetchColumn();

    }

}