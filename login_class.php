<?php

require "Helpers/functions.php";
require "Database/pdo.php";
$page = "login";

if (isset($_POST['login'])) {

    $email = e($_POST['email']);
    $password = e($_POST['password']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $verify = password_verify(123456789, '$2y$10$6gmZNNQrtZCjBy/z2G7i8.akttPG/r.IXxZm5I7PgqEdfEd.cY6c2');
    if ($verify) {
        echo "Ok";
    } else {
        echo "Pas Ok";
    }
    exit;
    dd($password);
    // ' or ''='
    // $user = $pdo->query("SELECT * FROM users WHERE email = '$email' and password = '$password' LIMIT 1")->fetch();

    $req = $pdo->prepare("SELECT * FROM users WHERE 
    email = :email_123 
    AND 
    password = :password 
    LIMIT 1");

    $req->execute(
        [
            'email_123' => $email,
            'password' => $password,
        ]
    );

    dd($req);
    $user = $req->fetch();
    if ($user) {
        $_SESSION['message'] = "Bien connecter";
        $_SESSION['color'] = 'info';
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['message'] = "Email ou mot de paase incorrecte !!!";
        $_SESSION['color'] = 'danger';
        header('Location: login.php');
        exit;
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
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

        <h2 class="my-4">Login</h2>


        <?php if (isset($_SESSION['message']) and isset($_SESSION['color'])) : ?>
            <p class="alert alert-<?= $_SESSION['color'] ?>">
                <?= $_SESSION['message'] ?>
            </p>
            <?php unset($_SESSION['message']) ?>
            <?php unset($_SESSION['color']) ?>
        <?php endif ?>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </nav>


        <form method="post">
            <label for="">Email:</label>
            <input type="text" name="email" class="form-control mt-2">
            <label for="">Password:</label>
            <input type="password" name="password" class="form-control mt-2">
            <button type="submit" class="btn btn-dark fw-bol mt-3" name="login">Login</button>
        </form>




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