<?php
namespace App;
use \RedBeanPHP\R as R;

class Person{
    public function __construct()
    {
        
    }

    public function createPerson($nom,$prenom,$sexe,$filiere,$email,$mdp){
        $selectEmailPerson = $this->selectionEmailPerson($email);
        if(empty($selectEmailPerson)){
        $person = R::dispense('person');
        $person ->nom = $nom;
        $person ->prenom = $prenom;
        $person ->sexe = $sexe;
        $person ->filiere = $filiere;
        $person ->email = $email;
        $person ->mdp = $mdp;
        $person ->statut = 1;
        return R::store( $person );
        }else{
            return 0;
        }
    } 


    public function selectionEmailPerson($email){
        $selectEmailPerson =  R::getRow( 'SELECT * FROM person WHERE email=:email  LIMIT 1 ',
            [ ':email' => $email,]);
        return $selectEmailPerson;
    }

    public function connectPerson($email,$mdp){
        $connectPerson = R::getRow( 'SELECT * FROM person WHERE email=:email AND mdp=:mdp  LIMIT 1',
            [ ':email' => $email , 
            ':mdp' => $mdp 
            ]  
        );
        return $connectPerson;
    }

    public function readPersonById($idperson){
        $readPersonById =  R::getRow( 'SELECT * FROM person WHERE id='.$idperson.' AND statut = 1');
        return $readPersonById;
    }

    public function readAllPerson(){
        $readAllPerson = R::getAll( 'SELECT * FROM person WHERE statut = 1');
        return $readAllPerson;
    }

    public function updatePersonById($idperson,$email,$mdp){
        $updatePersonById = R::exec("UPDATE person set email='".$email."',mdp='".$mdp."' WHERE id=".$idperson);
        return $updatePersonById;
    }
    public function updatePersonEmail($idperson,$email){
        $updatePersonEmail = R::exec("UPDATE person set email='".$email."' WHERE id=".$idperson);
        return $updatePersonEmail;
    }
    public function updatePersonMdp($idperson,$mdp){
        $updatePersonMdp = R::exec("UPDATE person set mdp='".$mdp."' WHERE id=".$idperson);
        return $updatePersonMdp;
    }

    public function deletePersonById($idperson){
        $deletePersonById =  R::exec('UPDATE person set statut = 0 WHERE id ='.$idperson);
        return $deletePersonById;
    }
}