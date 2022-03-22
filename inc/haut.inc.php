<!Doctype html>
<html>
    <head>
        <title>Vit'ment</title>
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/style.css">
    </head>
    <body>    
        <header>
            <div class="conteneur">
                <div>
                    <a href="" title="Mon Site">Vit'ment !</a>
                <!-- Je construis la navbarre de mon site. J'incluerais ce morceau de code dans chaque page avec la fonction include() -->
                </div>
                <nav>

                    <?php

                    //Les liens pour accéder aux différentes pages du site ! J'utilise une fonction "internauteEstConnecteEtAdmin()"
                    //"internauteEstConnecte()" et autre pour les personnes n'ayant pas de compte. Il y aura un affichage différent
                    //Selon les cas


                    //Affichage pour les admin connectés
                        if(internauteEstConnecteEtAdmin()){

                            echo '<a href="#">Gestion des membres</a>';
                            echo '<a href="#">Gestion des commandes</a>';
                            echo '<a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a>';
                        }
                    //Affichage pour les simples mmebres 
                        if(internauteEstConnecte()){
                            echo '<a href="' . RACINE_SITE . 'profil.php">Voir votre profil</a>';
                            echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                            echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                            echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
                        } 
                    
                    //Affichage pour les personnes n'ayant pas de compte
                        else{

                            echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                            echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
                            echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                            echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                            
                        }
                    ?>

                </nav>
            </div>
        </header>

        <section>
            <div class="conteneur">