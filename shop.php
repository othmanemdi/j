<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "shop";

$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <?php require "body/nav.php" ?>
    </header>
    <main class="container">
        <h3 class="my-3">Shop Page</h3>


        <div class="row">
            <div class="col-md-3">
                <div class="position-sticky">
                    <h5>Catégories</h5>

                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach ($categories as $key => $c) : ?>

                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                <label class="form-check-label" for="firstCheckbox">
                                    <?= ucwords($c['nom']) ?>
                                </label>
                            </li>

                        <?php endforeach ?>

                    </ul>


                    <h5>Couleurs</h5>

                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach ($categories as $key => $c) : ?>

                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                <label class="form-check-label" for="firstCheckbox">
                                    <?= ucwords($c['nom']) ?>
                                </label>
                            </li>

                        <?php endforeach ?>

                    </ul>

                </div>
                <!-- position-sticky -->
            </div>
            <!-- col -->

            <div class="col-md-9">


                <div class="row">

                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="card mb-3">
                                <img src="images/products/product_img<?= $i ?>.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Product <?= $i ?></h5>
                                    <h5>
                                        250,00 DH
                                        <del class="text-danger fw-bold">
                                            300,00 DH
                                        </del>
                                    </h5>
                                    <a href="#" class="btn btn-dark">Add to cart</a>
                                </div>
                            </div>
                            <!-- card -->
                        </div>
                        <!-- col -->
                    <?php endfor ?>




                </div>
                <!-- row -->


            </div>
            <!-- col -->
        </div>
        <!-- row -->








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