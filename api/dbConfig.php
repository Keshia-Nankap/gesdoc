<?php

use \RedBeanPHP\R as R;
return function ():bool
{try{  
    require_once ("../vendor/autoload.php");
    $config = file_get_contents(__DIR__ . './config.json');
    $config = json_decode($config,true);
    R::setup($config["db"],$config["login"],$config["password"]);
    return $retour["is_connection_successful"]=true;
}catch(Exception $e){
    return $retour["is_connection_successful"]=false;
}
};