<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Entradas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border: 1px solid #ddd;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #0065ff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        a {
            display: block;
            margin: 20px auto;
            width: fit-content;
            text-decoration: none;
            color: white;
            background-color: #910000;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #6e0000;
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

<?php
if (isset($_SESSION['success_message'])) {
    echo "<h2>" . htmlspecialchars($_SESSION['success_message']) . "</h2>";
    if (isset($_SESSION['total_price'])) {
        echo "<h3>El precio total de su compra es: " . htmlspecialchars($_SESSION['total_price']) . " €</h3>";
    }

    unset($_SESSION['success_message'], $_SESSION['total_price']);
}
?>

<h2>Mis Entradas</h2>

<?php if (!empty($purchases)) { ?>
    <table>
        <thead>
        <tr>
            <th>Película</th>
            <th>Número de entradas</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($purchases as $purchase) { ?>
            <tr>
                <td><?php echo htmlspecialchars($purchase->movie); ?></td>
                <td><?php echo htmlspecialchars($purchase->numTickets); ?></td>
                <td><?php echo htmlspecialchars((new DateTime($purchase->date))->format('d/m/Y')); ?></td>
            </tr>
        <?php } ?>
        </tbody>
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

<?php } else { ?>
    <p>No tienes entradas compradas aún.</p>
<?php } ?>

<a href="/user/indexCinema">Volver al inicio</a>

</body>
</html>