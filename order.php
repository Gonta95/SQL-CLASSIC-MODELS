<?php
// CHARGEMENT DES LIBRAIRIES
require_once './lib/debug.php';
require_once './lib/format.php';
require_once './lib/route.php';

// CHARGEMENT DU MODEL
require_once './model/database.php';
require_once './model/products.php';
require_once './model/customers.php';
require_once './model/employees.php';
require_once './model/orders.php';
require_once './model/orderdetails.php';



// SI ON A REÇU UN ID DANS L'URL
if (isset($_GET['id'])) {

    // ON RÉCUPÈRE CET ID
    $id = $_GET['id'];
} else {
    // SINON ON RETOURNE SUR LA PAGE D'ACCUEIL
    redirect('index.php');
}

$orderByNumbers = getOrderByNumber($id);
// d($orderByNumbers);

// SI LE CLIENT N'EXISTE PAS
if(empty($orderByNumbers)) {

    // ON RETOURNE SUR LA PAGE D'ACCUEIL
    redirect('index.php');
}


$orderDetails = getOrder($id);
// d($orderDetails);


// CHARGEMENT DU TEMPLATE DE LA PAGE
include './templates/order.phtml';


