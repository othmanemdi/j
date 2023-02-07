<?php

session_start();
unset($_SESSION['auth']);
$_SESSION['message'] = 'Vous êtes maintenant déconnecté';
$_SESSION['message'] = 'info';
header('Location: login.php');
exit;
