<?php
require "Helpers/functions.php";
require "Database/pdo.php";
$page = "cart";

$ip_adresse = get_client_ip();


$cart_id = $pdo->query("SELECT id FROM carts WHERE ip_adresse = '$ip_adresse' limit 1")->fetch()['id'];




$cart_produit = $pdo->query("SELECT pv.*,
cp.qt AS cart_quantite
FROM cart_produit cp
LEFT JOIN produits_view pv ON pv.id = cp.produit_id
WHERE cp.cart_id = $cart_id
")->fetchAll();

// $prix_total_cart = 0;

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



        <h2 class="my-4">Cart Page</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>


        <div class="row">
            <div class="col-md-8">
                <h6>Articles</h6>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_produit as $key => $p) : ?>
                                <?php
                                $total_prix =  $p['prix'] * $p['cart_quantite'];
                                // $prix_total_cart = $prix_total_cart +  $total_prix;
                                // $prix_total_cart += $total_prix;
                                ?>
                                <tr>
                                    <td>
                                        <img width="30" src="images/<?= $p['image'] ?>" alt="">
                                    </td>
                                    <td>
                                        <?= ucwords($p['designation']) ?>
                                        <?= ucwords($p['couleur_nom']) ?>
                                    </td>
                                    <td> <?= $p['prix'] ?> DH</td>
                                    <td>
                                        <!-- <input type="number" class="form-control w-25" value="1"> -->
                                        <div class="input-group w-50">
                                            <button class="btn btn-outline-secondary fw-bold" type="button" onclick="down(1)">
                                                <i class="fa-solid fa-minus fa-sm"></i>
                                            </button>
                                            <input type="text" readonly class="form-control text-center" placeholder="Quantity:" value="<?= $p['cart_quantite'] ?>" id="qt_1">

                                            <button class="btn btn-outline-secondary fw-bold" type="button" onclick="up(1)">
                                                <i class="fa-solid fa-plus fa-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td><?= $total_prix ?> DH</td>
                                    <td>
                                        <i class="fa-solid fa-trash-can text-danger fw-bold"></i>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- col -->


            <div class="col-md-4">

                <h6>Summary Of Your Order</h6>

                <div class="bg-light p-3 rounded">


                    <div class="d-flex mb-3">
                        <div class="me-auto">
                            <input type="text" class="form-control" placeholder="COUPON CODE">
                        </div>
                        <div>
                            <button class="btn btn-dark fw-bold">Apply</button>
                        </div>
                    </div>
                    <!-- d-flex -->

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold bg-transparent">
                            Order Summary
                            <span class="badge bg-dark rounded-pill">
                                <?= $prix_total_cart ?> DH
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold bg-transparent">
                            Discount
                            <span class="badge bg-dark rounded-pill">
                                200,00 DH
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold bg-transparent">
                            Total To Pay
                            <span class="badge bg-dark rounded-pill">
                                <?= $prix_total_cart - 200 ?> DH
                            </span>
                        </li>
                    </ul>

                    <a href="proced_checkout.html" class="btn btn-dark fw-bold mt-3 rounded">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        Proced To Chekout
                    </a>

                </div>
                <!-- bg-light -->

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