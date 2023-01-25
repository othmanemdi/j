<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "shop";

if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Error id";
    $_SESSION['color'] = "danger";
    header('Location: shop.php');
    exit();
}
$id = (int)$_GET['id'];

if ($id <= 0) {
    $_SESSION['message'] = "Id $id incorecte";
    $_SESSION['color'] = "danger";
    header('Location: shop.php');
    exit();
}


$p = $pdo->query("SELECT * FROM produits_view
WHERE id = $id AND deleted_at IS NULL LIMIT 1
")->fetch();

if (!$p) {
    $_SESSION['message'] = "Id $id introuvable";
    $_SESSION['color'] = "danger";
    header('Location: shop.php');
    exit();
}



if (isset($_POST['add_to_cart'])) {

    $ip_adresse = get_client_ip();

    $cart_info = $pdo->query("SELECT id FROM carts WHERE ip_adresse =  '$ip_adresse' LIMIT 1")->fetch();

    if (!$cart_info) {
        // echo 'insert';
        $pdo->query("INSERT INTO carts SET ip_adresse = '$ip_adresse'");
        $cart_id = (int)$pdo->lastInsertId();
    } else {
        // echo 'get';
        $cart_id = (int)$cart_info['id'];
    }

    $cart_produit = $pdo->query("SELECT id FROM cart_produit WHERE cart_id = $cart_id 
     AND produit_id = $id  LIMIT 1")->fetch();

    if (!$cart_produit) {
        echo 'insert';
        $pdo->query("INSERT INTO cart_produit SET cart_id = $cart_id,  produit_id = $id");
        $_SESSION['message'] = "Bien ajouter";
        $_SESSION['color'] = "success";
    } else {
        echo 'update';
        $pdo->query("UPDATE cart_produit SET qt = QT + 1 WHERE cart_id = $cart_id 
        AND produit_id = $id");
        $_SESSION['message'] = "Bien modifier";
        $_SESSION['color'] = "info";
    }

    header("Location: cart.php");
    exit();
}

$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

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
        <h3 class="my-3">Product Details </h3>


        <div class="row">
            <div class="col-md-6">
                <img src="images/<?= $p['image'] ?>" class="img-fluid" alt="">
            </div>

            <div class="col-md-6">
                <h4>
                    <?= ucwords($p['designation']) ?>
                    <?= ucwords($p['couleur_nom']) ?>
                </h4>

                <div>
                    <span class="text-warning">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
                    </span>
                    (75K)
                </div>

                <p class="my-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio non, sed, accusamus debitis sint recusandae suscipit dolorem et deserunt magnam vero. Vero ea cum nemo. Enim eveniet numquam maiores qui.
                </p>


                <form method="post">
                    <div class="row">
                        <div class="col">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select size:</option>
                                <option value="1">S</option>
                                <option value="2">M</option>
                                <option value="3">L</option>
                                <option value="4">XL</option>
                            </select>
                        </div>
                        <!-- col -->

                        <div class="col">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select color:</option>
                                <option value="1">Red</option>
                                <option value="2">Black</option>
                                <option value="3">White</option>
                                <option value="4">Gray</option>
                                <option value="5">Purple</option>
                            </select>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->
                </form>


                <h3 class="my-3 fw-bold">
                    <?= $p['prix'] ?> DH
                    <del class="text-danger fw-bold">
                        <?= $p['ancien_prix'] ?> DH
                    </del>
                </h3>

                <form method="post">
                    <button type="submit" name="add_to_cart" class="btn btn-dark fw-bold">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Add To Cart
                    </button>
                </form>
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