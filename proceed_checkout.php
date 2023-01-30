<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "shop";



$ip_adresse = get_client_ip();


$cart_id = $pdo->query("SELECT id FROM carts WHERE ip_adresse = '$ip_adresse' limit 1")->fetch()['id'];


$cart_produit = $pdo->query("SELECT pv.*,
cp.qt AS cart_quantite
FROM cart_produit cp
LEFT JOIN produits_view pv ON pv.id = cp.produit_id
WHERE cp.cart_id = $cart_id
")->fetchAll();


if (isset($_POST['confirm_order'])) {

    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $ville = $_POST['ville'];



    $pdo->beginTransaction();

    try {
        // Client info
        $client_info = $pdo->query("SELECT id FROM clients WHERE nom = '$nom' AND telephone = '$telephone' AND ville = '$ville' LIMIT 1")->fetch();

        if ($client_info) {
            $client_id = $client_info['id'];
        } else {
            $pdo->query("INSERT INTO clients SET nom = '$nom',telephone = '$telephone',ville = '$ville' ");
            $client_id = $pdo->lastInsertId();
        }
        // Paiement electronique

        // Creation de la commande

        // $pdo->query("INSERT INTO commandes SET client_id = $client_id, num += 1  ");

        $pdo->query("INSERT INTO commandes SET client_id = $client_id, num = num + 1  ");
        $commande_id = $pdo->lastInsertId();


        // Copier les produits de panier vers la table commande_produit

        foreach ($cart_produit as $key => $cp) {
            $produit_id = $cp['id'];
            $qt = $cp['cart_quantite'];
            $pdo->query("INSERT INTO commande_produit SET commande_id  = $commande_id, produit_id  = $produit_id , qt = $qt ");
        }
        // vIDER LE PANIER
        $pdo->query("DELETE FROM cart_produit WHERE cart_id  = $cart_id");
        $pdo->query("DELETE FROM carts WHERE ip_adresse  = '$ip_adresse'");
    } catch (\Throwable $e) { // use \Exception in PHP < 7.0
        $pdo->rollBack();
        throw $e;
    }
    $pdo->commit();

    header('Location: thanks-page.php');
    exit;
}






$prix_total_cart = $pdo->query("SELECT
SUM(pv.prix * cp.qt) AS prix_total_cart
FROM cart_produit cp
LEFT JOIN produits_view pv ON pv.id = cp.produit_id
WHERE cp.cart_id = $cart_id")->fetch()['prix_total_cart'];
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




        <h2 class="my-4">Proced To Checkout Page</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proced To Checkout</li>
            </ol>
        </nav>
        <form method="post">

            <div class="row">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input name="nom" type="text" class="form-control" id="name" placeholder="Name:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number:</label>
                                        <input name="telephone" type="number" class="form-control" id="phone" placeholder="Phone Number:">
                                    </div>
                                </div>
                                <!-- col -->


                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City:</label>
                                        <input name="ville" type="text" class="form-control" id="city" placeholder="City:">
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->

                        </div>
                        <!-- card-body -->
                    </div>
                    <!-- card -->

                </div>
                <!-- col -->


                <div class="col-md-4">

                    <div class="bg-light p-3 rounded">


                        <div class="d-flex mb-3">
                            <div class="me-auto">
                                <h3 class="fw-bold">
                                    Total:
                                </h3>
                            </div>
                            <div>
                                <h3 class="fw-bold">
                                    <?= _number_format($prix_total_cart) ?> DH
                                </h3>
                            </div>
                        </div>
                        <!-- d-flex -->



                        <ul class="list-group">
                            <?php foreach ($cart_produit as $key => $p) : ?>

                                <li class="list-group-item bg-transparent">

                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="images/<?= $p['image'] ?>" alt="..." width="40">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-bold">
                                                <?= ucwords($p['designation']) ?>
                                                <?= ucwords($p['couleur_nom']) ?>
                                            </h6>
                                            <div class="fw-bold">
                                                <?= _number_format($p['prix']) ?> DH (<?= $p['cart_quantite'] ?> Qty)
                                            </div>

                                        </div>
                                        <!-- flex-grow-1 -->
                                    </div>
                                    <!-- d-flex -->

                                </li>
                            <?php endforeach ?>

                        </ul>



                        <button type="submit" name="confirm_order" class="btn btn-dark fw-bold mt-3 rounded">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            Confirm Order
                        </button>

                    </div>
                    <!-- bg-light -->

                </div>
                <!-- col -->

            </div>
            <!-- row -->
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