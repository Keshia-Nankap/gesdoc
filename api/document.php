<?php

header('Content-Type:application/json');

$dbConnect = require './dbConfig.php';
$dbConnectResult = $dbConnect();

session_start(); 
$routes = 'home';
if (isset($_GET['r'])){
    $routes = $_GET['r'];
}

use App\Document;
$document = new Document();

switch($routes){
    case 'import-document':
        if(empty($_POST["type"]) || empty($_FILES["file"]) || empty($_POST["filiere"])){
            $retour["error"]="veuillez renseignez tous les champs";
        }else{
            $countFiles = count(array($_FILES['file']['name']));
            $file_registration_indicator = false;
            for($i=0;$i<$countFiles;$i++){
                $name = $_FILES["file"]["name"];
                if(move_uploaded_file($_FILES['file']['tmp_name'], "../documents/$name")) $file_registration_indicator = true;
                else {
                    $file_registration_indicator = false;
                    break;
                    $createDocument = $document->createDocument($_POST['type'], $name, $_POST['filiere']);
                }
            }

        } 
        echo json_encode($file_registration_indicator); 
        // echo json_encode($_FILES["file"]["name"]);
    break;
}