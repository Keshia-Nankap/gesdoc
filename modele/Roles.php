<?php
namespace App;
use \RedBeanPHP\R as R;

class Roles{
    public function __construct()
    {
        
    }

    public function createRoles($nom, $statut){
        $selectRoleBynom =  $this->selectRole($nom);
        if(empty($selectRoleBynom)){
        $roles = R::dispense('roles');
        $roles->nom = $nom;
        $roles->statut = 1;
        return R::store( $roles);
        }else{
            return 0;
        }
    }

    public function selectRole($nom){
        $selectRoleBynom = R::getRow( 'SELECT * FROM roles WHERE nom=:nom  LIMIT 1 ',
            [ ':nom' => $nom,]);
        return $selectRoleBynom;
    }

    public function readRolesById($idroles){
        $readRolesByid = R::getRow( 'SELECT * FROM roles WHERE id='.$idroles.' AND statut = 1');
        return $readRolesByid;
    }

    public function readAllRoles(){
        $readAllRoles = R::getAll( 'SELECT * FROM roles WHERE statut = 1');
        return $readAllRoles;
    }

    public function updateRolesById($idroles, $nom){
        $updateRolesById = R::exec("UPDATE roles set passwords='".$nom."' WHERE id=".$idroles);
        return $updateRolesById;
    }
}