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
        if(empty($_POST['nom'])){
            $retour["error"]="veuillez inserer un role";
        }else{
            $createRole = $role->createRoles($_POST['nom']);   
            if(isset($_POST['nom'])){
                if($createRole > 0){
                    $retour["message"]="bonne creation du role";
                }else{
                    $retour["message"]="ce role existe deja";
                }
            }
        }
        echo json_encode($retour);   
    break;
    case 'roleperson':
        $idperson = $_POST['idperson'];
        $idrole = $_POST['idrole'];
        if(empty($idperson) || empty($idrole)){
            $retour["error"] = "vous devez preciser la personne et son role";
        }else{
            $createRolePerson = $roleperson->createRoleperson($idperson,$idrole);
            $retour["message"] = "l'attribution de role a l'utilisateur a ete fait avec success.";
        }
        echo json_encode($retour);
    break;
}

