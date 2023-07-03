<?php

// CHARGEMENT DES LIBRAIRIES
require_once './lib/debug.php';
require_once './lib/format.php';
require_once './lib/route.php';

// CHARGEMENT DU MODEL
require_once './model/database.php';
require_once './model/customers.php';
require_once './model/orders.php';
// require_once './model/products.php';

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
// $product = getProduct($id);

// CHARGE LES DONNÉES DU CLIENT
$customer = getCustomer($id);

// SI LE PRODUIT N'EXISTE PAS
if(empty($customer)) {
    redirect('index.php');
}

// RECUPERE TOUTES LES COMMANDES DU Client
$orders = getOrdersByCustomerNumber($id);


include './templates/customer.phtml';


