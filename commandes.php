<?php
require "Helpers/functions.php";
require "Database/pdo.php";
$page = 'commandes';




$commandes = $pdo->query("SELECT c.*,cl.nom AS client_nom
-- ,cl.telephone.cl.ville
FROM commandes c
LEFT JOIN clients cl ON cl.id = c.client_id
ORDER BY id DESC")->fetchAll();


?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des commandes</title>
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

        <h3 class="my-3">Gestion des commandes</h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>


        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Gestion des commandes</h4>
            </div>
            <!-- card-header -->

            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered table table-stripeda table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Num</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($commandes as $key => $c) : ?>

                                <tr>
                                    <td>
                                        <?= $c['id'] ?>
                                    </td>

                                    <td>
                                        BC<?= $c['num'] ?>
                                    </td>
                                    <td>
                                        <?= ucwords($c['client_nom']) ?>
                                    </td>

                                    <td>
                                        <?= _date_format($c['date_commande']) ?>
                                    </td>
                                    <td>
                                        <a href="commande_details.php?id=<?= $c['id'] ?>" class="btn btn-dark btn-sm fw-bold">
                                            Aficher
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>
                    </table>
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