<?php 



function executeRequete($req)
{
    global $mysqli;
    $resultat = $mysqli->query($req);
    if(!$resultat) 
    {
        die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code: " . $req);
    }
    return $resultat; 
}

function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].";
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}

//------------------------

function internauteEstConnecte(){

    if(!isset($_SESSION['membre']))
    
        return false;
    else
        return true;

}

//-------------------------

function internauteEstConnecteEtAdmin(){

    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1)
        return true;
    else
        return false;
}

//-----------------------------

function creationDuPanier()
{
   if(!isset($_SESSION['panier']))
   {
      $_SESSION['panier'] = array();
      $_SESSION['panier']['titre'] = array();
      $_SESSION['panier']['ID_produit'] = array();
      $_SESSION['panier']['quantite'] = array();
      $_SESSION['panier']['prix'] = array();
   }
}

//------------------------------------

function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix)
{
    creationDuPanier(); 
    $position_produit = array_search($id_produit,  $_SESSION['panier']['ID_produit']);
    if($position_produit !== false)
    {
         $_SESSION['panier']['quantite'][$position_produit] += $quantite ;
    }
    else
    {
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['ID_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }
}

//------------------------------------
function montantTotal(){
    $total=0;
    for($i = 0; $i < count($_SESSION['panier']['ID_produit']); $i++)
    {
       $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }
    return round($total,2); 
 }
 
 //------------------------------------
 function retirerProduitDuPanier($id_produit_a_supprimer)
 {
     $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['ID_produit']);
     if ($position_produit !== false)
     {
         array_splice($_SESSION['panier']['titre'], $position_produit, 1);
         array_splice($_SESSION['panier']['ID_produit'], $position_produit, 1);
         array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
         array_splice($_SESSION['panier']['prix'], $position_produit, 1);
     }
 }

?>