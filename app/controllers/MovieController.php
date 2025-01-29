<?php

namespace App\Controllers;

use App\Models\Movie;
use App\Models\Purchases;
use App\Models\Product;
use Core\ValidationTickets;
use Core\ValidationUpdate;

class MovieController
{
    public function __construct()
    {
        $this->validateSessionTimeout();
    }

    private function validateSessionTimeout()
    {
        session_start();

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 120) {
            session_unset();
            session_destroy();
            header("Location: /user/login/expired");
            exit;
        }

        $_SESSION['last_activity'] = time();
    }

    public function index($idCinema)
    {
        $idCinema = intval($idCinema);

        // Obtener la página actual (por defecto, la primera página)
        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        // Número de registros por página
        $recordsPerPage = 3;

        // Calcular el offset para la consulta
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Obtener el total de registros (para calcular el número total de páginas)
        $totalRecords = Movie::countByCustomer($idCinema);
        $totalPages = ceil($totalRecords / $recordsPerPage);

        // Obtener las compras para la página actual
        //$purchases = Purchases::getByCustomerWithPagination($idCustomer, $recordsPerPage, $offset);
        $movies = Movie::index($idCinema, $recordsPerPage, $offset);

        require_once __DIR__ . "/../views/indexMovie.php";
    }

    public function getTickets($idMovie)
    {
        $idMovie = intval($idMovie);
        $movies = Movie::getTickets($idMovie);
        $idCustomer = $_SESSION['idUser'];

        require_once __DIR__ . "/../views/confirmPurchase.php";
    }

    public function storeTickets()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idMovie = $_POST['idMovie'];
            $tickets = $_POST['tickets'];
            $idCustomer = $_POST['idCustomer'];
            $date = date("Y-m-d H:i:s");

            $errors = ValidationTickets::validateTicket($idMovie, $idCustomer, $tickets);

            if (!empty($errors)) {
                $movies = Movie::getTickets($idMovie);
                require_once __DIR__ . "/../views/confirmPurchase.php";
                return;
            }

            Purchases::store($idCustomer, $idMovie, $date, $tickets);
            $ticketsStore = Movie::getTickets($idMovie);
            $ticketsSubt = $ticketsStore->tickets - $tickets;
            Movie::insertNewTickets($idMovie, $ticketsSubt);

            $_SESSION['success_message'] = "¡Enhorabuena, {$_SESSION['username']}! Su compra se ha realizado con éxito.";
            $_SESSION['total_price'] = $tickets * 6;

            header("Location: /user/indexTickets/$idCustomer");
            exit;
        }
        require_once __DIR__ . "/../views/confirmPurchase.php";
    }

}