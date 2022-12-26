<?php
require "Helpers/functions.php";
require "Database/pdo.php";


if (isset($_POST['add_categorie'])) {
    $nom = $_POST['nom'];
    $categorie = $pdo->query("INSERT INTO categories SET nom = '$nom'");

    if ($categorie) {
        $_SESSION['message'] = "Bien Ajouter";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: categories.php");
    exit();
}



if (isset($_POST['update_categorie'])) {

    $id = $_POST['categorie_id'];
    $nom = $_POST['nom'];

    $categorie = $pdo->query("UPDATE categories SET nom = '$nom', updated_at = NOW() where id = $id");

    if ($categorie) {
        $_SESSION['message'] = "Bien Modifier";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: categories.php");
    exit();
}





if (isset($_POST['delete_categorie'])) {

    $id = $_POST['categorie_id'];

    $categorie = $pdo->query("UPDATE categories SET deleted_at = NOW() WHERE id = $id");

    if ($categorie) {
        $_SESSION['message'] = "Bien Supprimer";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: categories.php");
    exit();
}


$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des catégories</title>
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

        <h3 class="my-3">Gestion des catégories</h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>


        <div class="card">
            <div class="card-header">
                <h4>Gestion des catégories</h4>
            </div>
            <!-- card-header -->

            <div class="card-body">

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_category">
                    Ajouter
                </button>

                <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Ajouter une nouvelle catégorie
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- modal-header -->
                            <form method="post">
                                <div class="modal-body">

                                    <div>
                                        <label for="nom" class="form-label">Nom:</label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:">
                                    </div>

                                </div>
                                <!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" name="add_categorie" class="btn btn-primary">Ajouter</button>
                                </div>
                                <!-- modal-footer -->

                            </form>
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                <!-- modal -->


                <a href="categories_trash.php" class="btn btn-danger mb-3">Trash</a>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($categories as $key => $c) : ?>

                                <tr>
                                    <td>
                                        <?= $c['id'] ?>
                                    </td>
                                    <td>
                                        <?= ucwords($c['nom']) ?>
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#update_category_<?= $c['id'] ?>">
                                            Modifier
                                        </button>

                                        <div class="modal fade" id="update_category_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Modifier <?= ucwords($c['nom']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <form method="post">
                                                        <div class="modal-body">

                                                            <div>
                                                                <label for="nom" class="form-label">Nom:</label>
                                                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:" value="<?= $c['nom'] ?>">
                                                            </div>

                                                            <input type="hidden" name="categorie_id" value="<?= $c['id'] ?>">

                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update_categorie" class="btn btn-dark">Modifier</button>
                                                        </div>
                                                        <!-- modal-footer -->

                                                    </form>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- modal -->




                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_category_<?= $c['id'] ?>">
                                            Supprimer
                                        </button>

                                        <div class="modal fade" id="delete_category_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Supprimer <?= ucwords($c['nom']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <form method="post">
                                                        <div class="modal-body">

                                                            <h4 class="text-danger fw-bold">
                                                                Voulez vous vraiment supprimer <?= ucwords($c['nom']) ?> ?
                                                            </h4>

                                                            <input type="hidden" name="categorie_id" value="<?= $c['id'] ?>">

                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="delete_categorie" class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                        <!-- modal-footer -->

                                                    </form>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- modal -->




                                    </td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>
                    </table>
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