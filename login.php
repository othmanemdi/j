<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "login";


if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $input_email = htmlspecialchars(trim($_POST['email']));
        $input_password = htmlspecialchars(trim($_POST['password']));

        $req = $pdo->prepare('SELECT * FROM users WHERE email = :email  LIMIT 1');
        $req->execute(['email' => $input_email]);
        $user = $req->fetch();

        // echo '<pre>';
        // print_r(password_verify(1234567, $user->password));
        // echo '</pre>';

        // exit();
        if (password_verify($input_password, $user['password'])) {
            $_SESSION['auth'] = $user;
            $_SESSION['message'] = 'Vous êtes maintenant connecté';
            $_SESSION['color'] = 'success';
            header('Location: dashboard.php');
        } else {
            $_SESSION['message'] = 'Identifiant ou mot de passe incorrecte';
            $_SESSION['color'] = 'danger';

            header('Location: login.php');
        }
    }
    exit();
}

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

        <div class="row justify-content-md-center ">
            <div class="col-6">
                <div class="bg-light p-5 rounded-pilla rounded-3">
                    <h3 class="text-center mb-4">CRÉER UN NOUVEAU COMPTE CLIENT </h3>
                    <h5 class="text-center">SE CONNECTER</h5>

                    <form method="post" autocomplete="off" class="row g-3">
                        <div class="form-group">
                            <label class="form-label" for="email">Adresse mail: (<span class="text-kitea">*</span>)</label>

                            <input name="email" type="email" class="form-control" id="email" require placeholder="Veuillez saisir votre email SVP !">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Mot de passe: (<span class="text-kitea">*</span>)</label>

                            <input name="password" type="password" class="form-control" id="password" require placeholder="Veuillez saisir votre mot de passe SVP !">
                        </div>


                        <div class="d-flex  mb-3">
                            <div class="me-auto p-2 ">
                                <button type="submit" name="login" class="btn btn-info text-white">Connexion</button>
                            </div>
                            <div class="p-2 ">
                                <a href="forgotpassword" class="text-kitea fw-bold">Mot de passe oublié?</a>
                            </div>
                        </div>

                    </form>

                    <h5 class="text-center mt-4">Nouveaux clients</h5>
                    <hr>
                    <p class="text-center">
                        La création d’un compte a de nombreux avantages : consultation rapide, sauvegarder plusieurs adresses, suivre les commandes, et bien plus encore.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="register.php" class="btn btn-info text-white mt-4 text-center">Créer un compte</a>
                    </div>

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