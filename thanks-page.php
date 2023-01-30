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




        <h2 class="my-4">Thank You Page</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                <li class="breadcrumb-item"><a href="proced_checkout.html">Proced To Checkout</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proced To Checkout</li>
            </ol>

        </nav>



        <div class="alert alert-success">
            <h1 class="fw-bold text-center">
                <i class="fa-solid fa-circle-check"></i>
                Your Order Is Confirmed
            </h1>
        </div>

        <p class="text-center">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt dolorum sapiente ab non debitis, est
            aperiam natus maxime veniam doloribus explicabo eaque? Pariatur beatae laudantium aperiam voluptatem omnis,
            magnam doloremque.
            <br>


            <a href="shop.php" class="btn btn-outline-dark fw-bold mt-3">
                <i class="fa-solid fa-cart-shopping"></i>

                Return To Shop Page
            </a>
        </p>


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