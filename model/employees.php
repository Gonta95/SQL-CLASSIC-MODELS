<?php
require_once './model/database.php';


function getBestEmployees():array{
        // CONNECTION A LA BDD
        $database = connect();
        // CODE SQL A EXECUTER
        $SQL =  'SELECT `employees`.`employeeNumber`, `employees`.`lastName`, `employees`.`firstName`, `offices`.`city`,
        ROUND(SUM(`orderdetails`.`quantityOrdered`*`orderdetails`.`priceEach`),2) AS `CA`
        FROM `employees` 
        JOIN `offices` ON `offices`.`officeCode`= `employees`.`officeCode`
        JOIN `customers` ON `customers`.`salesRepEmployeeNumber` = `employees`.`employeeNumber`
        JOIN `orders` ON `orders`.`customerNumber` = `customers`.`customerNumber`
        JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
        GROUP BY `employees`.`employeeNumber`
        ORDER BY `CA` DESC
        LIMIT 5;';
        // PREPARATION DE LA REQUETE
        $query = $database->prepare($SQL);
        // EXECUTION DE LA REQUETE
        $query->execute();
        //  RECUPERATION DES DONNES DE LA REQUETE
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
        // RENVOIE LES DATAS FINALES
        return $datas;
};

function getEmployee(int $employeeNumber): array{
    
        // CONNECTION À LA BDD
        $database = connect();
      
        // CODE SQL À EXÉCUTER
        $SQL = 'SELECT `employees`.`employeeNumber` , 
        `employees`.`lastName`, 
        `employees`.`firstName`, 
        `employees`.`lastName`,
        `employees`.`email`,
        `employees`.`reportsTo`,
        `employees`.`jobTitle`,
        `offices`.`city`,
        `offices`.`phone`,
        `offices`.`officeCode`,
        `offices`.`addressLine1`,
        `offices`.`addressLine2`,
        `offices`.`postalCode`, 
        `offices`.`state`,
        `offices`.`country`,
        `offices`.`territory`,
         ROUND(SUM(`orderdetails`.`quantityOrdered`* `orderdetails`.`priceEach`), 2) AS `CA`
        FROM `employees` 
        JOIN `offices` ON `offices`.`officeCode` = `employees`.`officeCode`
        JOIN `customers` ON `customers`.`salesRepEmployeeNumber` = `employees`.`employeeNumber`
        JOIN `orders`ON `orders`.`customerNumber` = `customers`.`customerNumber`
        JOIN `orderdetails` ON `orderdetails`.`orderNumber` = `orders`.`orderNumber`
        WHERE `employees`.`employeeNumber` = :employeeNumber';
        
        // PRÉPARATION DE LA REQUÊTE
        $query = $database->prepare($SQL);
      
        // EXÉCUTION DE LA REQUÊTE
        $query-> execute([
            ':employeeNumber' => $employeeNumber
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
      