<?php

namespace Core;

use App\Models\Movie;
use App\Models\Purchases;
use App\Models\Product;

class ValidationTickets
{
    private static function sanitizeInput($data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public static function validateTicket($idMovie, $idCustomer, $quantity)
    {
        $errors = [];

        $quantity = self::sanitizeInput($quantity);
        if (empty($quantity)) {
            $errors["quantity"] = "* Debes introducir la cantidad de entradas";
        }

        if($quantity < 1){
            $errors["quantity"] = "* Debes introducir una cantidad mayor a 0";
        }

        $movie = Movie::getTickets($idMovie);
        $totalTickets = $movie->tickets;
        $ticketsSold = intval( Purchases::getTicketsSold($idMovie));
        $ticketsAvailable = $totalTickets - $ticketsSold;

        if($quantity > $ticketsAvailable){
            $errors["quantity"] = "* No hay suficientes entradas disponibles";
        }

        $purchase = Purchases::getPurchase($idMovie, $idCustomer);
        if($purchase){
            $errors["quantity"] = "* Ya has comprado entradas para esta película";
        }

        return $errors;
    }










}