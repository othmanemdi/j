<?php
require "Helpers/functions.php";
require "Database/db.php";
require "Database/pdo.php";
 
$produits = $pdo->query("SELECT * FROM produits ORDER BY id DESC")->fetchAll();

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
            Jumia
        </h1>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>

        <a href="product_add.php" class="btn btn-primary mb-3">Ajouter</a>

        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Quantité</th>
                    <th>Ancien Prix</th>
                    <th>Prix U</th>
                    <th>Prix Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $key => $p) { ?>
                    <tr>
                        <td>
                            <?= $p['id'] ?>
                        </td>

                        <td>
                            <img width="40" src="images/<?= $p['id'] ?>.jpg" alt="">
                        </td>
                        <td>
                            <?= strtoupper($p['reference']) ?>
                        </td>
                        <td>
                            <?= ucwords($p['designation']) ?>
                        </td>
                        <td>
                            <?= $p['quantite'] ?>
                        </td>
                        <td>
                            <?=
                            number_format($p['ancien_prix'], 2, ',', ' ')
                            ?>
                            DH
                        </td>

                        <td>
                            <?=
                            number_format($p['prix'], 2, ',', ' ')
                            ?>
                            DH
                        </td>
                        <td>
                            <?=
                            number_format($p['prix'] * $p['quantite'], 2, ',', ' ')
                            ?>
                            Dh
                        </td>
                        <td>

                            <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">
                                Détails <?= $p['id'] ?>
                            </a>

                            <a href="product_update.php?id=<?= $p['id'] ?>" class="btn btn-dark btn-sm">Modifier</a>
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <!-- container -->
</body>

</html>