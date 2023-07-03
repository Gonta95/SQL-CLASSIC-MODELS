<?php
// CHARGEMENT DES LIBRAIRIES
require_once './lib/debug.php';
require_once './lib/format.php';

// CHARGEMENT DU MODEL
require_once './model/database.php';
require_once './model/products.php';
require_once './model/customers.php';
require_once './model/employees.php';
require_once './model/orders.php';


// SI ON A REÇU UN ID DANS L'URL
if (isset($_GET['id'])) {

    // ON RÉCUPÈRE CET ID
    $id = $_GET['id'];
} else {
    // SINON ON RETOURNE SUR LA PAGE D'ACCUEIL
    redirect('index.php');
}

// CHARGE LES DONNÉES DE LA COMMANDE
$employee = getEmployee($id);


if(empty($employee)) {
    redirect('index.php');
}

/* Si l'employé existe, la variable $boss appel la fonction getEmployee(), 
la fonction getEmployee() est utilisée pour récupérer les informations 
du supérieur hiérarchique de l'employé. */
$boss = getEmployee($employee['reportsTo']);


$orders = getOrdersByEmployeNumber($id);


// d($employee);




// CHARGEMENT DU TEMPLATE DE LA PAGE
require_once './templates/employee.phtml';