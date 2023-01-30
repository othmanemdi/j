<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// echo $number_1 + $number_2;

function somme(int|float $value_1 = 0, int|float $value_2 = 0): int|float
{
    return $value_1 + $value_2;
}

function sousstraction(int|float $value_1 = 0, int|float $value_2 = 0): int|float
{
    return $value_1 - $value_2;
}

function muliplication(int|float $value_1 = 0, int|float $value_2 = 0): int|float
{
    return $value_1 * $value_2;
}

function division(int|float $value_1 = 0, int|float $value_2 = 0): int|float|string
{
    // if ($value_2 != 0) {
    //     return $value_1 / $value_2;
    // } else {
    //     return 'Error';
    // }

    // if ($value_2 != 0)
    //     return $value_1 / $value_2;
    // return 'Error';

    return $value_2 != 0 ? $value_1 / $value_2 : 'Error';
}


$prenom = 'othmane';
$nom = 'mdi';

function full_name(string $first_name, string $last_name): string
{
    $full_name = $first_name . ' ' . $last_name;
    return ucwords($full_name);
}

// echo full_name($prenom, "mdi ");


function calculatrice(float $value_1, string $operation, float $value_2): int|float|string
{
    switch ($operation) {
        case '+':
            return somme($value_1, $value_2);
            break;
        case '-':
            return sousstraction($value_1, $value_2);
            break;
        case '*':
            return  muliplication($value_1, $value_2);
            break;
        case '/':
            return division($value_1, $value_2);
            break;

        default:
            return  "Eroor";
            break;
    }
}


function dd($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}


function dd2($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit();
}



function array_to_json($array)
{
    return json_encode($array);
}

function json_to_array($array)
{
    return json_decode($array, true);
}

function create_cookie($key, $value, $lifetime): void
{
    setcookie($key, $value, $lifetime);
}

function create_json_cookie($key, $array_php, $lifetime): void
{
    $value = array_to_json($array_php);
    setcookie($key, $value, $lifetime);
}




// CRUD

// C = CREATE
// R = READ
// U = UPDATE
// D = DELETE








// echo calculatrice(7, '/', 0);


// $_GET;
// $_POST;
// $_SERVER;
// $_SESSION;
// $_COOKIE;
// $_FILES;


function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function _number_format($num)
{
    return number_format($num, 2, ',', ' ');
}


if (!function_exists('_date_format')) {
    function _date_format($date)
    {
        return date("d/m/Y H:i:s", strtotime($date));
    }
}
