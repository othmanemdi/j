<?php
require "Helpers/functions.php";
require "Database/pdo.php";
$page = 'products';

$errors = [];




if (isset($_POST['ajouter_produit'])) {
    // dd($_POST);


    $image_name = "ooo" . $_FILES["image"]["name"];
    $image_type = $_FILES["image"]["type"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_error = $_FILES["image"]["error"];
    $image_size = $_FILES["image"]["size"];

    $target_dir = "images/";

    $target_file = $target_dir . basename($image_name);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // dd($imageFileType);

    $extention_autoriser = ['jpg', 'jpeg', 'png'];


    if (!in_array($imageFileType, $extention_autoriser)) {

        $errors[] = "Ce fichier n'est pas autorisé ";
        // echo "Ce fichier n'est pas autorisé ";
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        // $uploadOk = false;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     // echo " Sorry, file already exists.";
    //     $errors[] = "Sorry, file already exists.";

    //     // $uploadOk = false;
    // }

    // Check file size
    if ($image_size > 500000) {
        $errors[] = "Sorry, your file is too large.";

        // echo "Sorry, your file is too large.";
        // $uploadOk = false;
    }

    // if ($uploadOk == true) {
    //     move_uploaded_file($image_tmp_name, $target_file);
    //     echo "The file " . htmlspecialchars(basename($image_name)) . " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }

    // echo $text;
    // exit();


    if (empty($errors)) {
        move_uploaded_file($image_tmp_name, $target_file);
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $error_message = '';
        foreach ($errors as $key => $e) {
            $error_message  .= $e;
            $error_message  .= "<br>";
        }
        $_SESSION['flash']['danger'] = $error_message;
    }







    $reference = $_POST['reference'];
    $nom = $_POST['nom'];
    $categorie_id = (int)$_POST['categorie_id'];
    $couleur_id = (int)$_POST['couleur_id'];
    $quantite = (int)$_POST['quantite'];
    $prix = (float)$_POST['prix'];
    $ancien_prix = (float)$_POST['ancien_prix'];

    $categorie = $pdo->query("INSERT INTO produits 
    SET
    image = '$image_name',
    reference = '$reference',
    designation = '$nom',
    categorie_id = $categorie_id,
    couleur_id = $couleur_id,
    quantite = $quantite,
    prix = $prix,
    ancien_prix = $ancien_prix
    ");

    if ($categorie) {
        $_SESSION['message'] = "Bien Ajouter";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: products.php");
    exit();
}



if (isset($_POST['modifier_produit'])) {
    // dd($_POST);

    $id = $_POST['produit_id'];
    $image_name = $_POST['image_name'];
    $reference = $_POST['reference'];
    $nom = $_POST['nom'];
    $categorie_id = (int)$_POST['categorie_id'];
    $couleur_id = (int)$_POST['couleur_id'];
    $quantite = (int)$_POST['quantite'];
    $prix = (float)$_POST['prix'];
    $ancien_prix = (float)$_POST['ancien_prix'];



    if ($_FILES['image']['name'] != '') {

        unlink("images/" . $image_name);

        $image_name = $_FILES["image"]["name"];
        $image_type = $_FILES["image"]["type"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_error = $_FILES["image"]["error"];
        $image_size = $_FILES["image"]["size"];

        $target_dir = "images/";
        $target_file = $target_dir . basename($image_name);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $extention_autoriser = ['jpg', 'jpeg', 'png'];


        if (!in_array($imageFileType, $extention_autoriser)) {

            $errors[] = "Ce fichier n'est pas autorisé ";
            // echo "Ce fichier n'est pas autorisé ";
            $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            // $uploadOk = false;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            // echo " Sorry, file already exists.";
            $errors[] = "Sorry, file already exists.";

            // $uploadOk = false;
        }

        // Check file size
        if ($image_size > 500000) {
            $errors[] = "Sorry, your file is too large.";

            // echo "Sorry, your file is too large.";
            // $uploadOk = false;
        }

        // if ($uploadOk == true) {
        //     move_uploaded_file($image_tmp_name, $target_file);
        //     echo "The file " . htmlspecialchars(basename($image_name)) . " has been uploaded.";
        // } else {
        //     echo "Sorry, there was an error uploading your file.";
        // }

        // $text = 'Hind';

        // $text .= ' OHC';
        // $text = ' ZZZ';

        // echo $text;
        // exit();
        if (empty($errors)) {
            move_uploaded_file($image_tmp_name, $target_file);
            $_SESSION['flash']['info'] = 'Bien modifier';
        } else {
            $error_message = '';
            foreach ($errors as $key => $e) {
                $error_message  .= $e;
                $error_message  .= "<br>";
            }
            $_SESSION['flash']['danger'] = $error_message;
        }
    }

    $categorie = $pdo->query("UPDATE produits 
    SET
    reference = '$reference',
    image = '$image_name',
    designation = '$nom',
    categorie_id = $categorie_id,
    couleur_id = $couleur_id,
    quantite = $quantite,
    prix = $prix,
    ancien_prix = $ancien_prix,
    updated_at = NOW()
    WHERE id = $id
    ");

    if ($categorie) {
        $_SESSION['message'] = "Bien modifier";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: products.php");
    exit();
}



if (isset($_POST['supprimer_produit'])) {
    // dd($_POST);

    $id = $_POST['produit_id'];

    $categorie = $pdo->query("UPDATE produits 
    SET
    deleted_at = NOW()
    WHERE id = $id
    ");

    if ($categorie) {
        $_SESSION['message'] = "Bien supprimer";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['message'] = "Error";
        $_SESSION['color'] = "danger";
    }

    header("Location: products.php");
    exit();
}

$req = '';
if (isset($_GET['action']) and  $_GET['action'] == "deleted") {
    $req = "NOT";
}

$produits = $pdo->query("SELECT * FROM produits_view
WHERE deleted_at IS $req NULL
ORDER BY id DESC
")->fetchAll();



$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$couleurs = $pdo->query("SELECT * FROM couleurs")->fetchAll();

?>


<!doctype html>
<html lang="en">

<head>
    <title>Gestion des produits</title>
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

        <h3 class="my-3">Gestion des produits</h3>

        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>

        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Gestion des produits</h4>
            </div>
            <!-- card-header -->

            <div class="card-body">

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_category">
                    Ajouter
                </button>

                <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Ajouter un nouvau produit
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- modal-header -->


                            <form method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row g-3">

                                        <div class="col-md-4">

                                            <label for="reference" class="form-label">Référence:</label>
                                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence:">
                                        </div>
                                        <!-- col -->


                                        <div class="col-md-8">

                                            <label for="nom" class="form-label">Nom:</label>
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:">
                                        </div>
                                        <!-- col -->


                                        <div class="col-md-6">
                                            <label for="nom" class="form-label">Liste des catégories:</label>

                                            <select class="form-select" name="categorie_id">
                                                <?php foreach ($categories as $key => $c) : ?>
                                                    <option value="<?= $c['id'] ?>">
                                                        <?= ucwords($c['nom']) ?>
                                                    </option>
                                                <?php endforeach ?>


                                            </select>

                                        </div>

                                        <div class="col-md-6">
                                            <label for="nom" class="form-label">Liste des couleurs:</label>

                                            <select class="form-select" name="couleur_id">
                                                <?php foreach ($couleurs as $key => $cl) : ?>
                                                    <option value="<?= $cl['id'] ?>">
                                                        <?= ucwords($cl['nom']) ?>
                                                    </option>
                                                <?php endforeach ?>

                                            </select>

                                        </div>




                                        <div class="col-md-4">

                                            <label for="prix" class="form-label">Prix:</label>
                                            <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix:">
                                        </div>
                                        <!-- col -->

                                        <div class="col-md-4">

                                            <label for="ancien_prix" class="form-label">Ancient Prix:</label>
                                            <input type="number" class="form-control" id="ancien_prix" name="ancien_prix" placeholder="Ancient Prix:">
                                        </div>
                                        <!-- col -->


                                        <div class="col-md-4">

                                            <label for="quantite" class="form-label">Quantité:</label>
                                            <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité:">
                                        </div>
                                        <!-- col -->





                                        <div class="col-md-4">
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <!-- col -->



                                    </div>
                                    <!-- row -->

                                    <input type="hidden" name="produit_id" value="<?= $p['id'] ?>">

                                </div>
                                <!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" name="ajouter_produit" class="btn btn-dark">Ajouter</button>
                                </div>
                                <!-- modal-footer -->

                            </form>

                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                <!-- modal -->
                <?php if (isset($_GET['action']) and  $_GET['action'] == "deleted") : ?>
                    <a href="products.php" class="btn btn-success mb-3">Active</a>
                <?php else : ?>
                    <a href="products.php?action=deleted" class="btn btn-danger mb-3">Trash</a>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-bordered table table-stripeda table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Désignation</th>
                                <th>Prix</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($produits as $key => $p) : ?>

                                <tr class="<?= $p['id'] == 4 ? 'table-warning' : '' ?>">
                                    <td>
                                        <?= $p['id'] ?>
                                    </td>

                                    <td>
                                        <img width="30" src="images/<?= $p['image'] ?>" alt="">
                                    </td>
                                    <td>
                                        <?= ucwords($p['designation']) ?>
                                        <?= ucwords($p['couleur_nom']) ?>
                                    </td>

                                    <td>
                                        <?= $p['prix'] ?>
                                    </td>

                                    <td>
                                        <?= ucwords($p['categorie_nom']) ?>
                                    </td>


                                    <td>


                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#show_product_<?= $p['id'] ?>">
                                            Afficher
                                        </button>

                                        <div class="modal fade" id="show_product_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Afficher <?= ucwords($p['designation']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <div class="modal-body">



                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img src="images/<?= $p['image'] ?>" class="img-fluid">
                                                            </div>
                                                            <!-- col -->

                                                            <div class="col-md-8">



                                                                <dl class="row">
                                                                    <dt class="col-sm-3">
                                                                        Id
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= $p['id'] ?>
                                                                    </dd>


                                                                    <dt class="col-sm-3">
                                                                        Référence
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= ucwords($p['reference']) ?>
                                                                    </dd>

                                                                    <dt class="col-sm-3">
                                                                        Désignation
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= ucwords($p['designation']) ?> <?= ucwords($p['couleur_nom']) ?>
                                                                    </dd>


                                                                    <dt class="col-sm-3">
                                                                        Catégorie
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= ucwords($p['categorie_nom']) ?>
                                                                    </dd>


                                                                    <dt class="col-sm-3">
                                                                        Prix
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= $p['prix'] ?> DH
                                                                        <del class="text-danger fw-bold">
                                                                            <?= $p['ancien_prix'] ?> DH

                                                                        </del>
                                                                    </dd>



                                                                    <dt class="col-sm-3">
                                                                        Quantité
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        <?= $p['quantite'] ?>
                                                                    </dd>


                                                                </dl>

                                                            </div>
                                                            <!-- col -->
                                                        </div>
                                                        <!-- row -->

                                                    </div>
                                                    <!-- modal-body -->


                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- modal -->




                                        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#update_product_<?= $p['id'] ?>">
                                            Modifier
                                        </button>
                                        <div class="modal fade" id="update_product_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Modifier <?= ucwords($p['designation']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="row g-3">

                                                                <div class="col-md-4">

                                                                    <label for="reference" class="form-label">Référence:</label>
                                                                    <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence:" value="<?= $p['reference'] ?>">
                                                                </div>
                                                                <!-- col -->


                                                                <div class="col-md-8">

                                                                    <label for="nom" class="form-label">Nom:</label>
                                                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:" value="<?= $p['designation'] ?>">
                                                                </div>
                                                                <!-- col -->

                                                                <div class="col-md-6">
                                                                    <label for="couleur_id" class="form-label">Couleurs:</label>
                                                                    <select name="couleur_id" class="form-select">
                                                                        <?php foreach ($couleurs as $key => $cl) : ?>
                                                                            <option <?= $cl['id'] == $p['couleur_id'] ? 'selected' : '' ?> value="<?= $cl['id'] ?>">
                                                                                <?= strtoupper($cl['nom']) ?>
                                                                            </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <!-- col -->




                                                                <div class="col-md-6">
                                                                    <label for="categorie_id" class="form-label">Catégories:</label>
                                                                    <select name="categorie_id" class="form-select">
                                                                        <?php foreach ($categories as $key => $c) : ?>
                                                                            <option <?= $c['id'] == $p['categorie_id'] ? 'selected' : '' ?> value="<?= $c['id'] ?>">
                                                                                <?= $c['nom'] ?>
                                                                            </option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <!-- col -->




                                                                <div class="col-md-4">

                                                                    <label for="prix" class="form-label">Prix:</label>
                                                                    <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix:" value="<?= $p['prix'] ?>">
                                                                </div>
                                                                <!-- col -->

                                                                <div class="col-md-4">

                                                                    <label for="ancient_prix" class="form-label">Ancient Prix:</label>
                                                                    <input type="number" class="form-control" id="ancient_prix" name="ancient_prix" placeholder="Ancient Prix:" value="<?= $p['ancien_prix'] ?>">
                                                                </div>
                                                                <!-- col -->


                                                                <div class="col-md-4">

                                                                    <label for="quantite" class="form-label">Quantité:</label>
                                                                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité:" value="<?= $p['quantite'] ?>">
                                                                </div>
                                                                <!-- col -->





                                                                <div class="col-md-4">
                                                                    <label for="image" class="form-label">Image:</label>
                                                                    <input type="file" class="form-control" id="image" name="image">
                                                                </div>
                                                                <!-- col -->


                                                                <div class="col-md-4">
                                                                    <label for="image" class="form-label">Image:</label>
                                                                    <br>
                                                                    <img width="60" class="img-thumbnail" src="images/<?= $p['image'] ?>" alt="">

                                                                </div>
                                                                <!-- col -->

                                                            </div>
                                                            <!-- row -->
                                                            <input type="hidden" name="image_name" value="<?= $p['image'] ?>">
                                                            <input type="hidden" name="produit_id" value="<?= $p['id'] ?>">

                                                        </div>
                                                        <!-- modal-body -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="modifier_produit" class="btn btn-dark">Modifier</button>
                                                        </div>
                                                        <!-- modal-footer -->

                                                    </form>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                                            <!-- modal-dialog -->
                                        </div>
                                        <!-- modal -->








                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_product_<?= $p['id'] ?>">
                                            Supprimer
                                        </button>
                                        <div class="modal fade" id="delete_product_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Supprimer <?= ucwords($p['designation']) ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- modal-header -->
                                                    <div class="modal-body">

                                                        <h5 class="text-danger fw-bold">
                                                            Voulez vous vraiment supprimer
                                                            <?= ucwords($p['designation']) ?>
                                                            <?= ucwords($p['couleur_nom']) ?>
                                                            ?
                                                        </h5>

                                                    </div>
                                                    <!-- modal-body -->
                                                    <div class="modal-footer">
                                                        <form method="post">
                                                            <input type="hidden" name="produit_id" value="<?= $p['id'] ?>">
                                                            <button type="submit" name="supprimer_produit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                    <!-- modal-footer -->

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