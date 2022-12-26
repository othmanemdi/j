<?php

require "Helpers/functions.php";
require "Database/db.php";
require "Database/pdo.php";

if (isset($_POST['add_product'])) {
    $reference_input = $_POST['reference'];
    $designation_input = $_POST['designation'];
    $quantite_input = (int)$_POST['quantite'];
    $prix_input = (float)$_POST['prix'];
    $ancien_prix_input = (float)$_POST['ancien_prix'];

    $pdo->query("INSERT INTO produits 
    (id, reference, designation, quantite, prix, ancien_prix) 
    VALUES 
    (NULL, '$reference_input', '$designation_input', $quantite_input, $prix_input, $ancien_prix_input)");

    $_SESSION['message'] = "Bien Ajouter";
    $_SESSION['color'] = "success";
    header("Location: products.php");
    exit();
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Add Product</title>
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

        <h1>Add Product</h1>

        <form method="post">
            <label>Référence:</label>
            <br>
            <input type="text" name="reference">
            <br>
            <br>

            <label>Désignation:</label>
            <br>
            <input type="text" name="designation">
            <br>
            <br>

            <label>Quantité:</label>
            <br>
            <input type="number" name="quantite">
            <br>
            <br>


            <label>Prix:</label>
            <br>
            <input type="number" name="prix">
            <br>
            <br>

            <label>Ancien Prix:</label>
            <br>
            <input type="number" name="ancien_prix">
            <br>
            <br>

            <button type="submit" name="add_product">Enregistrer</button>
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