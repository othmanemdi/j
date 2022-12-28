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
                <img src="images/products/product_img2.jpg" class="img-fluid" alt="">
            </div>

            <div class="col-md-6">
                <h4>Red Shirt</h4>

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
                    250,00 DH
                    <del class="text-danger fw-bold">
                        300,00 DH
                    </del>
                </h3>

                <a href="cart.php" class="btn btn-dark fw-bold">

                    <i class="fa-solid fa-cart-shopping"></i>
                    Add To Cart
                </a>

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