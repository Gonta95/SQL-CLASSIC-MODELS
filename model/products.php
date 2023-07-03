<?php

require_once './model/database.php';


/* Renvoie la liste des produits presque épuisés */
 function getOutStockProducts():array{
    // CONNECTION A LA BDD
    $database = connect();
    // CODE SQL A EXECUTER
    $SQL =  'SELECT `productName`,
                    `productCode`,
                    `productScale`,
                    `quantityInStock`,
                    `productLine`
             FROM   `products` 
             WHERE  `quantityInStock` <= 200';
    // PREPARATION DE LA REQUETE
    $query = $database->prepare($SQL);
    // EXECUTION DE LA REQUETE
    $query->execute();
    //  RECUPERATION DES DONNES DE LA REQUETE
    $datas = $query->fetchAll(PDO::FETCH_ASSOC);
    // RENVOIE LES DATAS FINALES
    return $datas;
 }

 /* Renvoie la liste des meilleures ventes */
 function getBestSellersProducts():array{
      // CONNECTION A LA BDD
      $database = connect();
      // CODE SQL A EXECUTER
      $SQL =  'SELECT  `products`.`productCode`,
      `products`.`productName`, 
      SUM(`orderdetails`.`quantityOrdered`) as `quantity`
      FROM `products`
      JOIN `orderdetails` ON `orderdetails`.`productCode` = `products`.`productCode`
      GROUP BY `products`.`productCode`
      ORDER BY `quantity` DESC
      LIMIT 20';
                
      // PREPARATION DE LA REQUETE
      $query = $database->prepare($SQL);
      // EXECUTION DE LA REQUETE
      $query->execute();
      //  RECUPERATION DES DONNES DE LA REQUETE
      $datas = $query->fetchAll(PDO::FETCH_ASSOC);
      // RENVOIE LES DATAS FINALES
      return $datas;
 }

 

 /* Renvoie le nombre de produit par catégorie de produits */
 function getNbOfProductsByLine():array {
       // CONNECTION A LA BDD
       $database = connect();
       // CODE SQL A EXECUTER
       $SQL =  'SELECT `productLine`, COUNT(*) AS `quantity`
               FROM `products`
               GROUP BY `productLine`';
       // PREPARATION DE LA REQUETE
       $query = $database->prepare($SQL);
       // EXECUTION DE LA REQUETE
       $query->execute();
       //  RECUPERATION DES DONNES DE LA REQUETE
       $datas = $query->fetchAll(PDO::FETCH_ASSOC);
       // RENVOIE LES DATAS FINALES
       return $datas;
 }


 // Renboie le détail du produit spécifié

 function getProduct(string $productCode):array {

         // CONNECTION A LA BDD
         $database = connect();

         // CODE SQL A EXECUTER
         $SQL =  'SELECT *
                  FROM `products` 
                  WHERE `productCode` =  :productCode ;';

         // PREPARATION DE LA REQUETE
         $query = $database->prepare($SQL);

         // EXECUTION DE LA REQUETE
         $query->execute([
          ':productCode' => $productCode
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

