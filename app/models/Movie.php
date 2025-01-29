<?php
//Daniel Sanchez Medialdea

namespace App\Models;

use Core\Model;
use PDO;

#[\AllowDynamicProperties]

class Movie extends Model
{
    public static function index(int $cinema, $recordsPerPage, $offset)
    {
        $db = self::conection();
        $sql = "SELECT * FROM movies WHERE cinema = :cinema LIMIT :recordsPerPage OFFSET :offset";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':cinema', $cinema);
        $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public static function getTickets(int $idMovie)
    {
        $db = self::conection();
        $sql = "SELECT * FROM movies WHERE idMovie = :idMovie";
        $stm = $db->prepare($sql);
        $stm->bindParam(':idMovie', $idMovie);
        $stm->execute();
        $result = $stm->fetchObject(self::class);
        return $result;
    }

    public static function insertNewTickets(mixed $idMovie, mixed $ticketsSubt)
    {
        $db = self::conection();
        $sql = "UPDATE movies SET tickets = :tickets WHERE idMovie = :idMovie";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idMovie', $idMovie);
        $stmt->bindParam(':tickets', $ticketsSubt);
        $stmt->execute();
    }

    public static function countByCustomer(int $idCinema)
    {
        $db = self::conection();
        $sql = "SELECT COUNT(*) as total FROM movies WHERE cinema = :cinema";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':cinema', $idCinema);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }

}