<?php

header('Content-Type:application/json');

$dbConnect = require './dbConfig.php';
$dbConnectResult = $dbConnect();

session_start(); 
$routes = 'home';
if (isset($_GET['r'])){
    $routes = $_GET['r'];
}

use App\Person;
$person = new Person();
switch($routes){
    case 'signin':
        if(empty($_POST["login"]) || empty($_POST["mdp"])){
            $retour["error"]="login et mot de passe obligatoires";
        }else{
            $login = $_POST["login"];
            $mdp = $_POST["mdp"];
            $connectPerson = $person->connectPerson($login, $mdp);
            if(empty($connectPerson)){
                $retour["message"]="login ou mot de passe incorrect";
            }else{
                $_SESSION['id'] = $connectPerson['id'];
                $_SESSION['email'] = $connectPerson['email'];
                $_SESSION['mdp'] = $connectPerson['mdp'];
                $retour["message"]="connexion réussie";
            }
        }
        echo json_encode($retour);
    break;
}

