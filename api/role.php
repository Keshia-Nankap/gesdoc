<?php

header('Content-Type:application/json');

$dbConnect = require './dbConfig.php';
$dbConnectResult = $dbConnect();

session_start(); 
$routes = 'home';
if (isset($_GET['r'])){
    $routes = $_GET['r'];
}

use App\Roleperson;
use App\Roles;
$roleperson = new Roleperson();
$role = new Roles();

switch($routes){
    case'createrole':
        
    break;
}