<?php
namespace App;
use \RedBeanPHP\R as R;

class Document{
    public function __construct()
    {
        
    }

    public function createDocument($type,$theme,$filiere){
        $selectDocumentByTheme = $this->selectDocumentByTheme($theme);
        if(empty($selectDocumentByTheme)){
            $document = R::dispense('document');
            $document->type = $type;
            $document->theme = $theme;
            $document->filiere = $filiere;
            $document->statut = 1;
            return R::store( $document);
        }else{
            return 0;
        }
        
    }

    public function selectDocumentByTheme($theme){
        $selectDocumentByTheme =  R::getRow( 'SELECT * FROM document WHERE theme=:theme  LIMIT 1 ',
            [ ':theme' => $theme,]);
        return $selectDocumentByTheme;
    }

    public function readDocumentById($iddocument){
        $readDocumentById =  R::getRow( 'SELECT * FROM document WHERE id='.$iddocument.' AND statut = 1');
        return $readDocumentById;
    }

    public function readAllDocument(){
        $readAllDocument =  R::getAll( 'SELECT * FROM document WHERE statut = 1');
        return $readAllDocument;
    }

    public function updateDocumentById ($theme, $iddocument){
        $updateDocumentById = R::exec("UPDATE person set theme='".$theme."' WHERE id=".$iddocument);
        return $updateDocumentById;
    }

}