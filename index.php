<?php
// CHARGEMENT DES LIBRAIRIES
require_once './lib/debug.php';
require_once './model/products.php';
require_once './model/customers.php';
require_once './lib/format.php';

// CHARGEMENT DU MODEL
require_once './model/database.php';
require_once './model/products.php';
require_once './model/employees.php';

// Chargement des datas en provenance du model
$outOfStock = getOutStockProducts();
$bestSellersProduct = getBestSellersProducts();
$bestCustomers = getBestCustomers();
$bestEmployees = getBestEmployees();
$productLines = getNbOfProductsByLine();
// d($outOfStock);
// d($bestSellersProduct);
// d($bestCustomers);
// d($productLines);


// Chargement du template de la page
include_once './templates/index.phtml';