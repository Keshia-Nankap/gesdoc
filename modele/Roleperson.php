<?php
namespace App;
use \RedBeanPHP\R as R;

class Roleperson{
    public function __construct()
    {
        
    }

    public function createRoleperson($idperson,$idroles){
        $roleperson = R::dispense( 'roleperson' );
        $roleperson ->statut = 1;
        $person = R::load('person', $idperson);
        $role = R::load('roles', $idroles);
        $person->ownRolepersonList[]=$roleperson;
        R::store($person);
        $role->ownRolepersonList[]=$roleperson;
        R::store($role);
        return R::store( $roleperson );
    }

    public function readRolepersonById($idroleperson){
        $readRolepersonById =  R::getRow( 'SELECT * FROM roleperson WHERE id='.$idroleperson.' AND statut = 1');
        return $readRolepersonById;
    }
    public function readAllRoleperson(){
        $readAllRolePerson = R::getAll( 'SELECT * FROM roleperson WHERE statut = 1');
        return $readAllRolePerson;
    }

    public function updateRolepersonById ($idroleperson){
        $updateRolepersonById = R::exec("UPDATE roleperson  WHERE id=".$idroleperson);
        return $updateRolepersonById;
    }

}