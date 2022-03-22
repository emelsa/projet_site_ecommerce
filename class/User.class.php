<?php 

class User {

    public function internauteEstConnecte(){

        if(!isset($_SESSION['membre']))
        
            return false;
        else
            return true;
    
    }

    public function internauteEstConnecteEtAdmin(){

        if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1)
            return true;
        else
            return false;
    }
}