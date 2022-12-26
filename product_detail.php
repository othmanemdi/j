<?php
require "Helpers/functions.php";
require "Database/db.php";
require "Database/pdo.php";

// $_GET;
// $_POST;
// $_SESION;
// $_COOKIE; v
// $_SERVER;
// $_FILE;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $p = $pdo->query("SELECT * FROM produits WHERE id = $id LIMIT 1")->fetch();;
} else {
    $_SESSION['message'] = "Erreur ID";
    $_SESSION['color'] = "danger";
    header('Location: products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <h1 style="color: orange;">
            Product Details
        </h1>

        <ul>
            <li>Référence: <?= $p['reference'] ?></li>
            <li>Désignation: <?= $p['designation'] ?></li>
            <li>Quantité: <?= $p['quantite'] ?></li>
            <li>Prix Unitére: <?= $p['prix'] ?></li>
        </ul>
        <img width="200" src="images/<?= $id ?>.jpg" alt="">

    </div>
    <!-- container -->
</body>

</html>