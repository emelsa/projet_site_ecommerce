Le nom de la base : site

//////////////////////

Dans un premier temps, j'ai créé la base des données du site sur PhpMyAdmin ('root', 'root').
J'ai procédé à la création des tables : 
    - 'membre' qui correspond aux inscrits du site
    - 'produit' qui correspond aux marchandises(ou service) vendues du site.
    - 'details_commande' qui comprend les produits, leurs quantités, leurs prix.
    - 'commande' qui correspond aux commandes que les membres passeront.

Ensuite, l'arborescence du code. Plusieurs dossiers ont été créé : 
    - Un dossier photo : contiendra toutes les photos de nos produits.
    - Un dossier admin : contiendra les pages d'administrations ( le BackOffice).
    - Un dossier inc : continedra les fichiers qui ne sont pas directement des pages web.
                       Se sont des fichiers inclus dans des pages web.
    - Dans le dossier principal (SITE_PROCEDURAL dans notre cas), il y a les fichiers côté front.
            -> Inscription.php 
            -> connexion.php
            -> panier.php
            -> ...

Ecriture des fichiers en inclusion (ceux qui ne sont pas directement des pages web).

init.inc.php => connexion à la base de données.




