<?php
require_once("inc/init.inc.php");
//TRAITEMENTS PHP

//AJOUT PANIER
if (isset($_POST['ajout_panier'])) {   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM produit WHERE ID_produit='$_POST[ID_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'], $_POST['ID_produit'], $_POST['quantite'], $produit['prix']);
}

// VIDER PANIER 
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}

//PAIEMENT 
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['ID_produit']) ; $i++) 
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE ID_produit=" . $_SESSION['panier']['ID_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de produit ' . $_SESSION['panier']['ID_produit'][$i] . ' a été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">Le produit ' . $_SESSION['panier']['ID_produit'][$i] . ' a été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                retirerProduitDuPanier($_SESSION['panier']['ID_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (ID_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['ID_membre'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['ID_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (ID_commande, ID_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['ID_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        // mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:vendeur@dp_site.com");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }
}

//AFFICHAGE DU HTML
include("inc/haut.inc.php");
echo $contenu;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th></tr>";

// Si le panier est vide
if (empty($_SESSION['panier']['ID_produit'])) 
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
} 
//Sinon on affiche les informations du produit (quantité, prix, etc...)
else { 
    for ($i = 0; $i < count($_SESSION['panier']['ID_produit']); $i++) {
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['ID_produit'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
        echo "</tr>";
    }
    //On affiche le montant total
    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " euros</td></tr>";

    //Si l'internaute est connecté, on procède au paiement
    if (internauteEstConnecte()) { 
        echo '<form method="post" action="">';
        echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
        echo '</form>';
    } 

    //Sinon, on réclame une inscription ou une connexion pour passer au paiement
    else {
        echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }

    //On oublie pas de laisser la possibilité à l'internaute de vider son panier.
    echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
}

echo "</table><br>";
echo "<i>Réglement par CHÈQUE uniquement à l'adresse suivante : Chambre de Commerce et de l'Industrie du Cher, 18000 Bourges</i><br>";
// echo "<hr>Session panier : <br>";
// debug($_SESSION);
include("inc/bas.inc.php");
