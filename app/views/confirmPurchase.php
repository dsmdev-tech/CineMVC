<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        .confirm {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .confirm p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .confirm h2,p strong {
            color: #0065ff;
        }

        button {
            background-color: #0065ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        button:hover {
            background-color: #0048bd;
        }

        a {
            text-decoration: none;
        }

        a:hover button {
            background-color: #0048bd;
        }

        .confirm form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .confirm input {
            width: 150px; /* Aumentar el tamaño del input */
            padding: 10px; /* Aumentar el relleno para hacerlo más grande */
            font-size: 16px; /* Aumentar el tamaño de la fuente */
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center; /* Centrar el número dentro del input */
        }

        /* Los botones estarán en línea debajo del input */
        .confirm .buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espacio entre los botones */
            margin-top: 20px; /* Espacio superior para separar los botones del input */
        }

        .error {
            color: #ff5646;
            font-size: 12px;
            display: block;
            margin-top: 3px;
        }

    </style>
</head>
<body>



<div class="confirm">

    <?php
    echo "<h2> Usuario " . $_SESSION['username'] . "</h2>"
    ?>

    <span class="error"><?= $errors["quantity"] ?? "" ?></span>

    <h3><strong>Hay <?= $movies->tickets ?> butacas libres de la pelicula <?= $movies->name ?> ¿Cuantas quieres? </strong></h3>
    <form action="/movie/storeTickets/<?= $movies->idMovie ?>" method="post">
        <input type="hidden" name="idMovie" value="<?= $idMovie ?>">
        <input type="hidden" name="idCustomer" value="<?= $idCustomer ?>">
        <input type="number" name="tickets">
        <div class="buttons">
            <button type="submit">Comprar</button>
        </div>
    </form>

    <a href="/user/indexCinema"><button>Cancelar</button></a>

</div>

</body>
</html>