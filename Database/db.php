<?php

$produits = [];

// $produits[1]['reference'] = 'rf-0001';
// $produits[1]['designation'] = 'iphone 14 pro max blue';
// $produits[1]['qt'] = 2;
// $produits[1]['prix_u'] = 18000;

// $produits[2]['reference'] = 'rf-0002';
// $produits[2]['designation'] = 'iphone 13 pro max gold';
// $produits[2]['qt'] = 1;
// $produits[2]['prix_u'] = 13000;


// $produits = [
//     1 => [
//         'reference' => 'rf-0001',
//         'designation' => 'iphone 14 pro max blue',
//         'qt' => 2,
//         'prix_u' => 18000,
//     ],
//     2 => [
//         'reference' => 'rf-0002',
//         'designation' => 'iphone 13 pro max gold',
//         'qt' => 1,
//         'prix_u' => 13000,
//     ],
// ];


// $produits = array(
//     1 => [
//         'reference' => 'rf-0001',
//         'designation' => 'iphone 14 pro max blue',
//         'qt' => 2,
//         'prix_u' => 18000,
//     ],
//     2 => [
//         'reference' => 'rf-0002',
//         'designation' => 'iphone 13 pro max gold',
//         'qt' => 1,
//         'prix_u' => 13000,
//     ],
// );

$produits = [
    1 => [
        'reference' => 'rf-0001',
        'designation' => 'iphone 14 pro max blue',
        'qt' => 2,
        'prix_u' => 18000,
    ],
    2 => [
        'reference' => 'rf-0002',
        'designation' => 'iphone 13 pro max gold',
        'qt' => 1,
        'prix_u' => 13000,
    ],
    3 => [
        'reference' => 'rf-0003',
        'designation' => 'imac orange',
        'qt' => 1,
        'prix_u' => 24000,
    ],
    4 => [
        'reference' => 'rf-0004',
        'designation' => 'imac Green',
        'qt' => 2,
        'prix_u' => 24000,
    ],
    5 => [
        'reference' => 'rf-0005',
        'designation' => 'imac Red',
        'qt' => 3,
        'prix_u' => 24000,
    ],
];

$produits = [];
// $produits_format_json = array_to_json($produits);

// $time = time() + 60 * 60 * 24 * 365;
// setcookie('produits', $produits_format_json, $time);


// if (isset($_COOKIE['produits'])) {
//     // echo $_COOKIE['produits'];
//     $produits_json_from_cookie = $_COOKIE['produits'];

//     $json_to_array = json_to_array($produits_json_from_cookie);

//     dd($json_to_array);
// } else
//     echo 'Error';
// exit();



$colors = [
    1 => 'black',
    'red',
    'orange',
];

// echo $produits[3]['reference'];
// exit();
// foreach ($produits as $produit_id => $p) {
//     echo 'Désignation ' . $p['designation'] . ' Prix ' . $p['prix_u'];
//     echo '<br>';
// }

// exit();



// echo '<pre>';
// * 60 * 24 * 365
// echo 'Time = ' . $time;
// echo '<br>';
// echo 'One Year = ' . $time;
// exit();
// dd($time);






// setcookie('name', 'reda', -1);

// exit();
