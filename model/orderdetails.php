<?php
require_once './model/database.php';


function getOrderByNumber(string $order): array{
    
    // CONNECTION À LA BDD
    $database = connect();

    // CODE SQL À EXÉCUTER
    $SQL = 'SELECT  `orders`.`orderNumber`,  
    `orders`.`orderDate`,  
    `orders`.`orderDate`, 
    `orders`.`status`, 
    `customers`.`customerNumber`,
    `customers`.`customerName`,
    `customers`.`contactLastName`,
    `customers`.`contactFirstName`,
    `customers`.`phone`,
    `customers`.`addressLine1`,
    `customers`.`addressLine2`,
    `customers`.`city`,
    `customers`.`state`,
    `customers`.`postalCode`,
    `customers`.`country`,
    `orders`.`comments`,
    ROUND(SUM(`orderdetails`.`priceEach`*`orderdetails`.`quantityOrdered`),2) as `TOTAL`
    FROM `orders`
    JOIN `customers` ON `customers`.`customerNumber` = `orders`.`customerNumber`
    JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
    WHERE `orders`.`orderNumber` = :order  
    GROUP BY `orders`.`orderNumber`; ';

    // PRÉPARATION DE LA REQUÊTE
    $query = $database->prepare($SQL);

    // EXÉCUTION DE LA REQUÊTE
    $query-> execute([
        ':order' => $order
    ]);

    // RÉCUPÉRATION DES DONNÉES DE LA REQUÊTE
    $datas = $query->fetch(PDO::FETCH_ASSOC);

     // SI IL N'Y A PAS DE RÉSULTAT
     if($datas === false){
        
        // IL FAUT QUAND MÊME RENVOYER UN TABLEAU VIDE
        $datas = [];
    } 

    // RENVOIE LES DATAS FINALES
    return $datas;
}