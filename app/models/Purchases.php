<?php

namespace App\Models;

use Core\Model;
use PDO;

#[\AllowDynamicProperties]

class Purchases extends Model
{
    public int $id_socio;
    public int $id_ejemplar;
    public string $fecha_prestamo;

    public static function all($page = 1)
    {
        $bd = self::conection();

        $limit = 3;
        $offset = ($page - 1) * $limit;

        $sql = "SELECT movies.name as movie, purchases.numTickets as numTickets, purchases.date as date 
                FROM purchases INNER JOIN movies ON purchases.idMovie = movies.id LIMIT :limit OFFSET :offset";

        $stm = $bd->prepare($sql);
        $stm->bindValue(":limit", $limit, \PDO::PARAM_INT);
        $stm->bindValue(":offset", $offset, \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function index(int $idCustomer)
    {
        $db = self::conection();
        $sql = "SELECT movies.name as movie, purchases.numTickets as numTickets, purchases.date as date 
                FROM purchases INNER JOIN movies ON purchases.idMovie = movies.idMovie WHERE idCustomer = :idCustomer";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idCustomer', $idCustomer);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public static function store( $idCustomer, $idMovie, $date, $numTickets)
    {
        $db = self::conection();
        $sql = "INSERT INTO purchases (idCustomer, idMovie, date, numTickets) VALUES (:idCustomer, :idMovie, :date, :numTickets)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idCustomer', $idCustomer);
        $stmt->bindParam(':idMovie', $idMovie);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':numTickets', $numTickets);
        $stmt->execute();

    }

    public static function getTicketsSold($idMovie)
    {
        $db = self::conection();
        $sql = "SELECT * FROM purchases WHERE idMovie = :idMovie";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idMovie', $idMovie);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function getPurchase($idMovie, $idCustomer)
    {
        $db = self::conection();
        $sql = "SELECT * FROM purchases WHERE idCustomer = :idCustomer AND idMovie = :idMovie";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idCustomer', $idCustomer);
        $stmt->bindParam(':idMovie', $idMovie);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function countByCustomer($idCustomer)
    {
        $db = self::conection();
        $stmt = $db->prepare("SELECT COUNT(*) AS total FROM purchases WHERE idCustomer = :idCustomer");
        $stmt->bindParam(':idCustomer', $idCustomer, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function getByCustomerWithPagination($idCustomer, $limit, $offset)
    {
        $db = self::conection();
        $stmt = $db->prepare("
        SELECT purchases.idCustomer, purchases.idMovie, purchases.date, purchases.numTickets, movies.name AS movie
        FROM purchases
        INNER JOIN movies ON purchases.idMovie = movies.idMovie
        WHERE purchases.idCustomer = :idCustomer
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindParam(':idCustomer', $idCustomer, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}