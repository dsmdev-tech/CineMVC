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
            color: #333;
        }
        h2 {
            font-size: 24px;
            color: #0065ff;
            margin-bottom: 20px;
            text-align: center;
        }

        h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0065ff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #666;
            margin-top: 20px;
        }

        button {
            background-color: #910000;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #6e0000;
        }

        .logout {
            margin-top: 20px;
            display: block;
        }

        .poster {
            width: 100px;
            height: 150px;
        }

        .pagination-list {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            padding: 0;
        }

        .pagination-item {
            margin: 0;
        }

        .pagination-link {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f3f4f6;
            color: #333;
        }

        .pagination-link.active {
            background-color: #5c6bc0;
            color: #fff;
        }

    </style>
</head>
<body>

<?php
echo "<h2> Usuario " . $_SESSION['username'] . "</h2>"
?>

<div class='buttons'>
    <a href="/user/indexTickets/<?= $_SESSION['idUser'] ?>"><button>Mis entradas</button></a>
    <a href="/user/indexCinema"><button>Cines</button></a>
</div>

<h3>Bienvenido a Poli_Cines</h3>

<?php
if(count($movies) > 0){ ?>

<table>
    <h4>Listado de todas los peliculas de la cadena</h4>
    <tr>
        <th>Nombre</th>
        <th>Año</th>
        <th>Nacionalidad</th>
        <th>Butacas libres</th>
        <th>Poster</th>
    </tr>
    <?php foreach($movies as $movie){
        echo "<tr>";
        echo "<td>" . $movie->name . "</td>";
        echo "<td>" . $movie->year . "</td>";
        echo "<td>" . $movie->nationality . "</td>";
        echo "<td>" . $movie->tickets . "</td>";
        echo "<td><img src='" . $movie->cover . "' alt='poster' class='poster'></td>";
        echo "<td><a href='/movie/getTickets/" . $movie->idMovie . "'> <button>Comprar </button></a></td>";
        echo "</tr>";
        }
    }
    ?>
</table>

<!-- Navegación de páginas -->
<div class="pagination">
    <?php if ($totalPages > 1) { ?>
        <nav>
            <ul class="pagination-list">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="pagination-item">
                        <a href="?page=<?= $i ?>" class="pagination-link <?= $i == $page ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>

<div class="logout">
    <a href="/user/indexCinema"><button>Salir</button></a>
</div>

</body>
</html>
