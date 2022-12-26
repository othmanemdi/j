<?php
require "Helpers/functions.php";
require "Database/pdo.php";



if (isset($_POST['active_categorie'])) {

    $id = $_POST['categorie_id'];

    $categorie = $pdo->query("UPDATE categories SET deleted_at = NULL WHERE id = $id");

    if ($categorie) {
        $_SESSION['message'] = "Bien Activer";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: categories_trash.php");
    exit();
}






$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NOT NULL ORDER BY id DESC")->fetchAll();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des catégories corbeille</title>
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

        <h3 class="my-3">Gestion des catégories corbeille</h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>


        <div class="card">
            <div class="card-header">
                <h4>Gestion des catégories corbeille</h4>
            </div>
            <!-- card-header -->

            <div class="card-body">

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



                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#active_category_<?= $c['id'] ?>">
                                            Activer
                                        </button>

                                        <div class="modal fade" id="active_category_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Activer <?= ucwords($c['nom']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <form method="post">
                                                        <div class="modal-body">

                                                            <h5 class="text-success fw-bold">
                                                                Voulez vous vraiment acvtiver <?= ucwords($c['nom']) ?> ?
                                                            </h5>

                                                            <input type="hidden" name="categorie_id" value="<?= $c['id'] ?>">

                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="active_categorie" class="btn btn-danger">Activer</button>
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