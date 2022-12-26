<?php

require "Helpers/functions.php";
require "Database/db.php";
require "Database/pdo.php";


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $p = $pdo->query("SELECT * FROM produits WHERE id = $id LIMIT 1")->fetch();
} else {
    $_SESSION['message'] = "Erreur ID";
    $_SESSION['color'] = "danger";
    header('Location: products.php');
    exit();
}

if (isset($_POST['update_product'])) {
    $reference_input = $_POST['reference'];
    $designation_input = $_POST['designation'];
    $quantite_input = (int)$_POST['quantite'];
    $prix_input = (float)$_POST['prix'];
    $ancien_prix_input = (float)$_POST['ancien_prix'];

    $pdo->query("UPDATE produits SET 
    reference = '$reference_input',
    designation = '$designation_input',
    quantite = $quantite_input,
    prix = $prix_input,
    ancien_prix = $ancien_prix_input
    WHERE id = $id
    ");

    $_SESSION['message'] = "Bien Modifier";
    $_SESSION['color'] = "success";
    header("Location: products.php");
    exit();
}





?>



<!doctype html>
<html lang="en">

<head>
    <title>Update Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="container">

        <h1>Update Product</h1>

        <form method="post">
            <label>Référence:</label>
            <br>
            <input type="text" name="reference" value="<?= $p['reference'] ?>">
            <br>
            <br>

            <label>Désignation:</label>
            <br>
            <input type="text" name="designation" value="<?= $p['designation'] ?>">
            <br>
            <br>

            <label>Quantité:</label>
            <br>
            <input type="number" name="quantite" value="<?= $p['quantite'] ?>">
            <br>
            <br>

            <label>Prix:</label>
            <br>
            <input type="number" name="prix" value="<?= $p['prix'] ?>">
            <br>
            <br>

            <label>Ancien Prix:</label>
            <br>
            <input type="number" name="ancien_prix" value="<?= $p['ancien_prix'] ?>">
            <br>
            <br>

            <button type="submit" name="update_product">Modifier</button>
        </form>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>