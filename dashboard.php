<?php
require "Helpers/functions.php";
$is_loged = is_loged();

if (!$is_loged) {
    header('Location: login.php');
    exit;
}


require "Database/pdo.php";
$page = 'Dashboard';

?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des couleurs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <?php require "body/nav.php" ?>
    </header>
    <main class="container">

        <h1>Tableau de bord bonjour <?= $_SESSION['auth']['prenom'] ?></h1>


        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>

        <div class="row my-3">
            <?php if ($_SESSION['auth']['role'] == "ADMIN") :  ?>
                <div class="col">
                    <div class="card card-body">
                        Total revenue:
                        <h5>$5 000 000,00</h5>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body">
                        Total commandes
                        <h5>80 000 commandes</h5>
                    </div>
                </div>
            <?php endif ?>

            <div class="col">
                <div class="card card-body">
                    Produits en stock
                    <h5>510 534 produits</h5>
                </div>
            </div>

            <div class="col">
                <div class="card card-body">
                    Caisse
                    <h5>$55 000,00</h5>
                </div>
            </div>
        </div>

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