<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Jumia</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'home' ? 'active text-info fw-bold' : '' ?>
                    " href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == 'shop' ? 'active text-info fw-bold' : '' ?>" href="shop.php">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == 'cart' ? 'active text-info fw-bold' : '' ?>" href="cart.php">Cart</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link <?= $page == 'categories' ? 'active text-info fw-bold' : '' ?>" href="categories.php">Categories</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link <?= $page == 'couleurs' ? 'active text-info fw-bold' : '' ?>" href="couleurs.php">Colors</a>
                </li>
            </ul>
        </div>
    </div>
</nav>