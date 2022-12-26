<?php
require "Helpers/functions.php";
require "Database/db.php";
require "Database/pdo.php";

$couleurs = $pdo->query("SELECT * FROM couleurs")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style="color:blue">Liste des couleurs</h1>

    <ul>
        <?php foreach ($couleurs as $key => $c) : ?>
            <li style="color: <?= $c['nom'] ?>">
                <?= $c['id'] ?> <?= $c['nom'] ?> <?= $c['date_created'] ?>
            </li>
        <?php endforeach ?>

    </ul>

</body>

</html>