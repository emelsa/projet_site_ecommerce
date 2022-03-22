<?php 
require_once("inc/init.inc.php");

//Traitement//

if(!internauteEstConnecte())
    header("location:connexion.php");
    //debug($_SESSION);
    $contenu .= "<p class='centre'>Bonjour <strong>" . $_SESSION['membre']['pseudo'] . "</strong></p>";
    $contenu .= "<div class='cadre'><h2> Voici vos informations </h2>";
    $contenu .= "<p>Votre email : ".$_SESSION['membre']['email']."<br>";
    $contenu .= "Votre ville : ".$_SESSION['membre']['ville']."<br>";
    $contenu .= "Votre code postal : ".$_SESSION['membre']['code_postal']."<br>";
    $contenu .= "Votre adresse : ".$_SESSION['membre']['adresse']."</p></div><br><br>";


//affichage HTML

require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");