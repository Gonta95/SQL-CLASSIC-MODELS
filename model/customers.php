<?php 

require_once './model/database.php';

/* Renvoie la liste des meilleurs clients */
function getBestCustomers():array{
      // CONNECTION A LA BDD
      $database = connect();
      // CODE SQL A EXECUTER
      $SQL =  'SELECT `customers`.`customerNumber`,`customers`.`customerName`,
      ROUND(SUM(`orderdetails`.`quantityOrdered`*`orderdetails`.`priceEach`),2) AS `CA`
      
      FROM `customers`
      
      JOIN `orders` ON `orders`.`customerNumber` = `customers`.`customerNumber`
      
      JOIN `orderdetails` ON   `orderdetails`.`orderNumber` = `orders`.`orderNumber`
      
      GROUP BY `customers`.`customerNumber`
      ORDER BY `CA` DESC
      LIMIT 3;';
      // PREPARATION DE LA REQUETE
      $query = $database->prepare($SQL);
      // EXECUTION DE LA REQUETE
      $query->execute();
      //  RECUPERATION DES DONNES DE LA REQUETE
      $datas = $query->fetchAll(PDO::FETCH_ASSOC);
      // RENVOIE LES DATAS FINALES
      return $datas;
}

/* Renvoie les données du client précis */
function getCustomer(int $customerNumber):array {
     // CONNECTION A LA BDD
     $database = connect();

     // CODE SQL A EXECUTER
     $SQL =  'SELECT `customers`.`customerNumber`,
     `customers`.`contactLastName`,
     `customers`.`contactFirstName`,
     `customers`.`addressLine1`,
     `customers`.`addressLine2`,
     `customers`.`phone`,
     `customers`.`country`, 
     `customers`.`state`,
     `customers`.`creditLimit`,
     `customers`.`postalCode`,
     `customers`.`salesRepEmployeeNumber`,
     `customers`.`city`, 
     `employees`.`lastName`,
     `employees`.`firstName`,
     `employees`.`email`,
     `employees`.`officeCode`, 
     `customers`.`customerName`, 
     `offices`.`city` as `officeCity`,
     `offices`.`country` as `officeCountry`,
     ROUND(SUM(`orderdetails`.`quantityOrdered`*`orderdetails`.`priceEach`),2) AS `CA`
     FROM `customers`
     JOIN `employees` ON `employees`.`employeeNumber` = `customers`.`salesRepEmployeeNumber`
     JOIN `offices` ON `offices`.`officeCode` = `employees`.`officeCode`
     JOIN `orders` ON `orders`.`customerNumber` = `customers`.`customerNumber`
     JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
     WHERE `customers`.`customerNumber` = :customerNumber
     GROUP BY `customers`.`customerNumber`;';

     // PREPARATION DE LA REQUETE
     $query = $database->prepare($SQL);

     // EXECUTION DE LA REQUETE
     $query->execute([
      ':customerNumber' => $customerNumber
     ]);

     //  RECUPERATION DES DONNES DE LA REQUETE
     $datas = $query->fetch(PDO::FETCH_ASSOC);

     // erreur, si il n'y a pas de résultat il faut quand meme renvoyer un tableau vide
     if($datas === false) {
            $datas = [];
     }
     // RENVOIE LES DATAS FINALES
     return $datas;
   }
