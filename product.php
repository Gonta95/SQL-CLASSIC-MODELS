<?php

// CHARGEMENT DES LIBRAIRIES
require_once './lib/debug.php';
require_once './lib/format.php';
require_once './lib/route.php';

// CHARGEMENT DU MODEL
require_once './model/database.php';
require_once './model/products.php';
require_once './model/orders.php';

//SI ON A RECU UN ID DANS L'URL
if (isset($_GET['id'])) {
    // ON RECUPERE  CET ID
    $id = $_GET['id'];
} else {
    // SINON
    //ON RETOURNE SUR LA PAGE D'ACCUEIL
    redirect('index.php');
}
// RECUPERE LE DETAIL DU PRODUIT
$product = getProduct($id);

// SI LE PRODUIT N'EXISTE PAS
if(empty($product)) {
    redirect('index.php');
}

// RECUPERE TOUTES LES COMMANDES DU PRODUIT
$orders = getOrdersByProductCode($id);

// d($orders);



// Chargement du template de la page
include './templates/product.phtml';