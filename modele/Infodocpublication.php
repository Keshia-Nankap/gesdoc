<?php
namespace App;
use \RedBeanPHP\R as R;

class Infodocpublication{
    public function __construct()
    {
        
    }

    public function createInfodoc($datepublication, $iddocument, $idroleperson){
        $infodocument = R::dispense('infodocument');
        $infodocument->datepublication = $datepublication;
        $infodocument->statut = 1;
        $document=R::load('document', $iddocument); 
        $idroleperson=R::load('roleperson', $idroleperson); 
        $document->ownInfodocumentList[]=$infodocument;
        R::store($document);
        $roleperson->ownInfodocumentList[]=$infodocument;
        R::store($roleperson);
        return R::store($infodocument);  
    }
}