<?php

namespace App\Controllers;

use App\Models\Cinemas;
use App\Models\Customer;
use App\Models\Purchases;
use App\Models\Product;
use Core\ValidationLogin;


class UserController
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

    public function login($argunments = [])
    {
        if (isset($argunments[0]) && $argunments[0] === "expired"){
            $expired = true;
        }

        require_once __DIR__ . "/../views/login.php";
    }


    public function storelogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = ValidationLogin::validate($email, $password);

            if (!empty($errors)) {
                require_once __DIR__ . "/../views/login.php";
                return;
            }

            $user = Customer::findByEmail($email);
            $_SESSION["username"] = $user['name'];
            $_SESSION["idUser"] = $user['idCustomer'];

            header("Location: /user/indexCinema");
            exit;
        }
        require_once __DIR__ . "/../views/login.php";
    }

    public function indexCinema()
    {
        $username = $_SESSION["username"];
        $cinemas = Cinemas::all();
        require_once  __DIR__ . "/../views/indexCinema.php";
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /user/login");
    }

    public function indexTickets($idCustomer)
    {
        $idCustomer = intval($idCustomer);

        // Obtener la página actual (por defecto, la primera página)
        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        // Número de registros por página
        $recordsPerPage = 3;

        // Calcular el offset para la consulta
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Obtener el total de registros (para calcular el número total de páginas)
        $totalRecords = Purchases::countByCustomer($idCustomer);
        $totalPages = ceil($totalRecords / $recordsPerPage);

        // Obtener las compras para la página actual
        $purchases = Purchases::getByCustomerWithPagination($idCustomer, $recordsPerPage, $offset);

        require_once __DIR__ . "/../views/indexTickets.php";
    }
}