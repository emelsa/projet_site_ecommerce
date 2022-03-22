<?php 

require_once("inc/init.inc.php");

// Traitements PHP
if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
    session_destroy();
} 

if(internauteEstConnecte()){
    
    header("location:profil.php");
}

if($_POST){

    // $contenu .= "pseudo : " . $_POST['pseudo'] . "<br> Mot de passe : " . $_POST['mdp'];
    $resultat = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0){

        //$contenu .= '<div style="background:green">Pseudo connu !</div>';
        $membre = $resultat->fetch_assoc();
        if($membre['mdp'] == $_POST['mdp']){

            //$contenu .= '<div class="validation">Mot de passe connu !</div>';
            foreach($membre as $indice =>$element){
                if($indice != 'mdp'){
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            header("location:profil.php");
        } else {
            $contenu .= "<div class='erreur'>Erreur de mot de passe</div>";
        }
    }
}


?>

<?php require_once("inc/haut.inc.php");?>
<?php echo $contenu;?>

<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="text" id="mdp" name="mdp"><br><br>

    <input type="submit" value="Se connecter">
</form>

<?php require_once("inc/bas.inc.php");?>