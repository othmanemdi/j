<?php
require "Helpers/functions.php";
require "Database/pdo.php";
$page = 'couleurs';


if (isset($_POST['add_couleur'])) {
    $nom = $_POST['nom'];
    $couleur = $pdo->query("INSERT INTO couleurs SET nom = '$nom'");

    if ($couleur) {
        $_SESSION['message'] = "Bien Ajouter";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: couleurs.php");
    exit();
}



if (isset($_POST['update_couleur'])) {

    $id = $_POST['couleur_id'];
    $nom = $_POST['nom'];

    $couleur = $pdo->query("UPDATE couleurs SET nom = '$nom', updated_at = NOW() where id = $id");

    if ($couleur) {
        $_SESSION['message'] = "Bien Modifier";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: couleurs.php");
    exit();
}





if (isset($_POST['delete_couleur'])) {

    $id = $_POST['couleur_id'];

    $couleur = $pdo->query("UPDATE couleurs SET deleted_at = NOW() WHERE id = $id");

    if ($couleur) {
        $_SESSION['message'] = "Bien Supprimer";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: couleurs.php");
    exit();
}







if (isset($_POST['active_couleur'])) {

    $id = $_POST['couleur_id'];

    $couleurs = $pdo->query("UPDATE couleurs SET deleted_at = NULL WHERE id = $id");

    if ($couleurs) {
        $_SESSION['message'] = "Bien Activer";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: couleurs.php?trash=trash");
    exit();
}

$trash = false;
$btn_color = 'danger';
$btn_name = 'Trash';
$btn_link = '?trash=trash';

if (isset($_GET['trash'])) {
    $trash = true;
    $btn_color = 'success';
    $btn_name = 'Normal';
    $btn_link = '';
}

$query = $trash ? "NOT" : '';

$couleurs = $pdo->query("SELECT * FROM couleurs WHERE deleted_at IS $query NULL  ORDER BY id DESC")->fetchAll();
?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des couleurs</title>
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

        <h3 class="my-3">Gestion des couleurs</h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>


        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Gestion des couleurs</h4>
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
                                    <button type="submit" name="add_couleur" class="btn btn-primary">Ajouter</button>
                                </div>
                                <!-- modal-footer -->

                            </form>
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                <!-- modal -->


                <a href="couleurs.php<?= $btn_link  ?>" class="btn btn-<?= $btn_color ?> mb-3"><?= $btn_name ?></a>

                <div class="table-responsive">
                    <table class="table table-bordered table table-stripeda table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($couleurs as $key => $c) : ?>

                                <tr class="<?= $c['id'] == 4 ? 'table-warning' : '' ?>">
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

                                                            <input type="hidden" name="couleur_id" value="<?= $c['id'] ?>">

                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update_couleur" class="btn btn-dark">Modifier</button>
                                                        </div>
                                                        <!-- modal-footer -->

                                                    </form>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- modal -->


                                        <?php if (!$trash) : ?>

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

                                                                <input type="hidden" name="couleur_id" value="<?= $c['id'] ?>">

                                                            </div>
                                                            <!-- modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="delete_couleur" class="btn btn-danger">Supprimer</button>
                                                            </div>
                                                            <!-- modal-footer -->

                                                        </form>
                                                    </div>
                                                    <!-- modal-content -->
                                                </div>
                                                <!-- modal-dialog -->
                                            </div>
                                            <!-- modal -->


                                        <?php else : ?>





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

                                                                <input type="hidden" name="couleur_id" value="<?= $c['id'] ?>">

                                                            </div>
                                                            <!-- modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="active_couleur" class="btn btn-danger">Activer</button>
                                                            </div>
                                                            <!-- modal-footer -->

                                                        </form>
                                                    </div>
                                                    <!-- modal-content -->
                                                </div>
                                                <!-- modal-dialog -->
                                            </div>
                                            <!-- modal -->

                                        <?php endif ?>


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