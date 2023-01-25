<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "shop";


$produits = $pdo->query("SELECT * FROM produits_view
WHERE deleted_at IS NULL
ORDER BY id DESC
")->fetchAll();


$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();
$couleurs = $pdo->query("SELECT * FROM couleurs WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>
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
                        <?php foreach ($couleurs as $key => $c) : ?>

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

                    <?php foreach ($produits as $key => $p) : ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="card mb-3">
                                <a href="product_detail.php?id=<?= $p['id'] ?>">
                                    <img src="images/<?= $p['image'] ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= ucwords($p['designation']) ?>
                                        <?= ucwords($p['couleur_nom']) ?>
                                    </h5>
                                    <h5>
                                        <?= $p['prix'] ?> DH
                                        <del class="text-danger fw-bold">
                                            <?= $p['ancien_prix'] ?> DH
                                        </del>
                                    </h5>
                                    <a href="cart.php?id=<?= $p['id'] ?>" class="btn btn-dark fw-bold">

                                        <i class="fa-solid fa-cart-shopping"></i>
                                        Add To Cart
                                    </a>
                                </div>
                            </div>
                            <!-- card -->
                        </div>
                        <!-- col -->
                    <?php endforeach ?>



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