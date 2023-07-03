<?php

function connect() {
    /* Connexion à une base MySQL avec l'invocation de pilote */
    $dsn = 'mysql:dbname=classicmodels;host=127.0.0.1';
    $user = 'root';
    $password = 'root';
    $database = new PDO($dsn, $user, $password);

    return $database;
}