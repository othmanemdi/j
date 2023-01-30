<?php
require "Helpers/functions.php";
require "Database/pdo.php";
$page = 'commandes';

if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Error Id";
    $_SESSION['color'] = "danger";
    header('Location: commandes.php');
    exit;
}

$commande_id = (int)$_GET['id'];


if ($commande_id <= 0) {
    $_SESSION['message'] = "Error Id";
    $_SESSION['color'] = "danger";
    header('Location: commandes.php');
    exit;
}

$commande_info = $pdo->query("SELECT c.*,
cl.nom AS client_nom,
cl.telephone,
cl.ville
FROM commandes c
LEFT JOIN clients cl ON cl.id = c.client_id 
WHERE c.id = $commande_id
LIMIT 1
")->fetch();

if (!$commande_info) {
    $_SESSION['message'] = "Commande introuvable";
    $_SESSION['color'] = "danger";
    header('Location: commandes.php');
    exit;
}
$commande_id = $commande_info['id'];
$num = "BC" . $commande_info['num'];
$client_nom = ucwords($commande_info['client_nom']);
$date_commande = _date_format($commande_info['date_commande']);

$commande_produit = $pdo->query("SELECT 
pv.*,
cp.qt 
FROM 
commande_produit cp
LEFT JOIN produits_view pv ON pv.id = cp.produit_id
WHERE cp.commande_id =  $commande_id 
ORDER BY cp.id DESC
")->fetchAll();

$qt_total = $prix_total = 0;
?>


<!doctype html>
<html lang="en">

<head>
    <title>Détails de commandes N° <?= $num ?></title>
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

        <h3 class="my-3">Détails de commande N° <?= $num ?></h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>


        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Détails de commande N° </h4>
            </div>
            <!-- card-header -->

            <div class="card-body">

                <dl class="row">
                    <dt class="col-sm-3">Numéro:</dt>
                    <dd class="col-sm-9">
                        <?= $num ?>
                    </dd>

                    <dt class="col-sm-3">Client:</dt>
                    <dd class="col-sm-9">
                        <?= $client_nom ?>
                    </dd>

                    <dt class="col-sm-3">Date de commande:</dt>
                    <dd class="col-sm-9">
                        <?= $date_commande ?>
                    </dd>

                </dl>

                <div class="table-responsive">
                    <table class="table table-bordered table table-stripeda table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Désignation</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Prix Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($commande_produit as $key => $p) : ?>

                                <?php
                                $qt_total += $p['qt'];
                                $prix_total += $p['prix'] * $p['qt'];
                                ?>

                                <tr>

                                    <td>
                                        <img width="30" src="images/<?= $p['image'] ?>" alt="">
                                    </td>
                                    <td>
                                        <?= ucwords($p['designation']) ?>
                                        <?= ucwords($p['couleur_nom']) ?>
                                    </td>

                                    <td>
                                        <?= ucwords($p['categorie_nom']) ?>
                                    </td>


                                    <td>
                                        <?= $p['qt'] ?>
                                    </td>

                                    <td>
                                        <?= _number_format($p['prix']) ?> DH
                                    </td>


                                    <td>
                                        <?= _number_format($p['prix'] * $p['qt']) ?> DH
                                    </td>

                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>




                <div class="d-flex flex-row-reverse">
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Quantité total:</th>
                                <td><?= $qt_total ?> Quantité<?= $qt_total > 1 ? 's' : '' ?></td>
                            </tr>

                            <tr>
                                <th>Prix total:</th>
                                <td><?= _number_format($prix_total) ?> DH</td>
                            </tr>
                        </table>
                    </div>
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