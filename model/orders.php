<?php

require_once './model/database.php';

/* Renvoie toutes les commandes contenant le produit spécifié */
function getOrdersByProductCode(string $productCode):array {
       // CONNECTION A LA BDD
       $database = connect();
       // CODE SQL A EXECUTER
       $SQL =  'SELECT  `orders`.`orderNumber`, 
                        `orders`.`orderDate`,
                        `orders`.`customerNumber`, 
                        `customers`.`customerName`, 
                        `orderdetails`.`priceEach`,  
                        `orderdetails`.`quantityOrdered`, 
                        ROUND(`orderdetails`.`quantityOrdered` * `orderdetails`.`priceEach` , 2) as `TOTAL`
       FROM `orders`
       JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
       JOIN `customers` ON `customers`.`customerNumber` = `orders`.`customerNumber`
       WHERE `orderdetails`.`productCode` = :productCode
       ORDER BY `orders`.`orderDate` DESC;';
       // PREPARATION DE LA REQUETE
       $query = $database->prepare($SQL);
       // EXECUTION DE LA REQUETE
       $query->execute([
        ':productCode' => $productCode
       ]);
       //  RECUPERATION DES DONNES DE LA REQUETE
       $datas = $query->fetchAll(PDO::FETCH_ASSOC);
       // RENVOIE LES DATAS FINALES
       return $datas;
}

//RENVOIE TOUTES LES COMMANDES PRODUIT SPECIFIE function getOrdersByCustomerNumber(string $customerNumber): array {     // CONNECTION A LA BDD     $database = connect();      // CODE SQL A EXECUTER / NE JAMAIS METTRE DE VARIABLE DIRECT '$'     // DANS LE SQL ON CREE UN TOKEN ':productCode'      $SQL = 'SELECT orders.orderNumber,                     orders.orderDate,                     orders.requiredDate,                     orders.shippedDate,                     orders.status,                     SUM(orderdetails.quantityOrdered) AS quantity,                     ROUND (SUM(orderdetails.quantityOrdered*orderdetails.priceEach),2) AS Total             FROM orders                 JOINorderdetailsONorderdetails.orderNumber=orders.orderNumber                 WHERE orders.customerNumber=141             GROUP BY orders.orderNumber             ORDER BY orders.orderDate DESC';     //POUR DATE ORDRE DECROISSANT = ORDRE ANTICHRONOLOGI
//RENVOIE TOUTES LES COMMANDES PRODUIT SPECIFIE
function getOrdersByCustomerNumber(string $customerNumber): array {
       // CONNECTION A LA BDD
       $database = connect();
   
       // CODE SQL A EXECUTER / NE JAMAIS METTRE DE VARIABLE DIRECT '$'
       // DANS LE SQL ON CREE UN TOKEN ':productCode' 
       $SQL = 'SELECT   `orders`.`orderNumber`, 
                        `orders`.`orderDate`,
                        `orders`.`requiredDate`,
                        `orders`.`shippedDate`,
                        `orders`.`orderDate`,
                        `orders`.`status`,
                        SUM(`orderdetails`.`quantityOrdered`) as `quantity`,
                        ROUND(SUM(`orderdetails`.`quantityOrdered`*`orderdetails`.`priceEach`), 2) as `total`
       FROM `orders`
       JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
       WHERE `orders`.`customerNumber` = :customerNumber
       GROUP BY `orders`.`orderNumber`
       ORDER BY `orders`.`orderDate` DESC;';
       //POUR DATE ORDRE DECROISSANT = ORDRE ANTICHRONOLOGIQUE
       
       //PREPARATION DE LA REQUETE
       $query = $database -> prepare($SQL);
   
       //EXECUTE LA REQUETE
       $query -> execute([
            ':customerNumber' => $customerNumber
       ]);
   
       //RECUPERATION DE LA REQUETE
       $datas = $query->fetchAll(PDO::FETCH_ASSOC);
   
   return $datas;
   
   }


   function getOrder(int $orderNumber):array{

    // connection ala BDD //
       $database = connect();
 
    // code SQL a executer  //
       $sql= 'SELECT orderdetails.productCode,
                     products.productName,
                     products.productLine,
                     products.productScale,
                     orderdetails.quantityOrdered,
                     orderdetails.priceEach,
                     ROUND(sum(orderdetails.quantityOrdered * orderdetails.priceEach),2) as  total
                    FROM orderdetails 
                    JOIN products ON products.productCode = orderdetails.productCode
                    WHERE orderdetails.orderNumber = :orderNumber
                    group by products.productCode;';
 
     // etape importante preparation de  la requete //
       $query = $database->prepare($sql);
 
    // etape importante  execution de  la requete //
        $query->execute([
       ':orderNumber' => $orderNumber
      ]); 
    // recuperation des donnees de la requetes  FETCH ASSOC  //
       $datas = $query->fetchAll(PDO::FETCH_ASSOC);
 
   //renvoie des datas finales // 
        return $datas;
}


 
/*  Renvoie toutes les commandes d'un client spécifié */

function getOrdersByEmployeNumber(string $employeNumber): array {

   // CONNECTION À LA BDD
   $database = connect();

   // CODE SQL À EXÉCUTER
   $SQL = 'SELECT  `orders`.`orderNumber`,  
                   `orders`.`orderDate`,  
                   `orders`.`requiredDate`,  
                   `orders`.`shippedDate`,  
                   `orders`.`status`,  
                   `customers`.`customerNumber`,  
                   `customers`.`customerName`, 
                   SUM(`orderdetails`.`quantityOrdered`) AS `quantity`,
                   ROUND(SUM(`orderdetails`.`quantityOrdered` * `orderdetails`.`priceEach`), 2) AS `total`
           FROM `orders` 
           JOIN `customers` ON `customers`.`customerNumber` = `orders`.`customerNumber`
           JOIN `employees` ON `employees`.`employeeNumber` = `customers`.`salesRepEmployeeNumber`
           JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
           WHERE `employees`.`employeeNumber` = :employeNumber
           GROUP BY `orders`.`orderNumber`
           ORDER BY `orders`.`orderDate` DESC;';

   // PRÉPARATION DE LA REQUÊTE
   $query = $database->prepare($SQL);

   // EXÉCUTION DE LA REQUÊTE
   $query->execute([
       ':employeNumber' => $employeNumber
   ]);

   // RÉCUPÉRATION DES DONNÉES DE LA REQUÊTE
   $datas = $query->fetchAll(PDO::FETCH_ASSOC);

   // RENVOIE LES DATAS FINALES
   return $datas;
}