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
    case 'signout':
        session_destroy();
    break;

    case'signup':
        if(empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["sexe"]) || empty($_POST["filiere"])|| empty($_POST["email"]) || empty($_POST["mdp"]))
        {
            $retour["error"]="veuillez renseigner tous les champs";
        }else{
            $createPerson = $person->createPerson($_POST["nom"],$_POST["prenom"],$_POST["sexe"],$_POST["filiere"],$_POST["email"],$_POST["mdp"]);
            if(isset($_POST["email"])){
                if($createPerson> 0){
                    $retour["message"]=" bonne creation d'une nouvelle personne";
                }else{
                    $retour["message"]=" cette personne existe deja";
                }
            }  
        }
        echo json_encode($retour);
    break;
    case'modifierPerson':
        $idperson = $_POST['idperson'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        if(empty($idperson)){
            $retour["error"]="on ne peut modifier une personne inexistante";
        }else{
            if(empty($email) && empty($mdp)){
                $retour["error"]="veuillez modifier au moins un des deux champs";
            }else{
                if(!empty($email) && !empty($mdp)){
                    $updatePersonById = $person->updatePersonById($idperson,$email,$mdp);
                    $retour["message"]="modifications de email et mot de passe effectuées avec succès";
                }
                else if(!empty($email) && empty($mdp)) {
                    $updatePersonEmail = $person->updatePersonEmail($idperson,$email);
                    $retour["message"]="modifications d'email effectué avec succès";
                }
                else if(!empty($mdp) && empty($email)) {
                    $updatePersonMdp = $person->updatePersonMdp($idperson,$mdp);
                    $retour["message"]="modifications de mot de passe effectué avec succès";
                }
            }
            echo json_encode($retour);
        }
    break;
    case'supprimerPerson':
        $idperson= $_POST['idperson'];
        $deletePerson = $person->deletePersonById($idperson);
        echo json_encode($deletePerson);
    break;
}

