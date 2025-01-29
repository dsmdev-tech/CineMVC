<?php

namespace App\Controllers;

use App\Models\Cinemas;
use App\Models\Movie;
use App\Models\Purchases;
use App\Models\Product;
use Core\ValidationTickets;
use Core\ValidationUpdate;

class CinemaController
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

    public function index($arguments = [])
    {
        //session_start();

        $page = isset($arguments[0]) ? intval($arguments[0]) : 1;
        $users = Cinemas::all();
        $totalRecords = Cinemas::countAll();
        $totalPages = ceil($totalRecords / 3);

        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
            $users = Purchases::all($page);
        }

        require_once __DIR__ . "/../views/indexAdmin.php";
    }

    public function indexMovie()
    {
        $movies = Movie::all();
        require_once  __DIR__ . "/../views/indexMovie.php";
    }


}