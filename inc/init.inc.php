<!-- Fichier qui permet l'initialisation de toutes nos pages web.
Nous allons nous en servir pour la connexion à la base de données. -->

<?php
//mysqli => class prédéfini en php permettant la connexion à la base de données.
$mysqli = new mysqli("localhost", "root", "root", "site"); //("serveur", "pseudo", "mdp", "nom de la bdd");
//la condition permet de retourner une erreur s'il y en a une lros de la connexion.
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
//règle l'encodage de la bdd
$mysqli->set_charset("utf8");
 
//session_start() permet de créer (ou lire) 1 fichier de session sur le serveur.
//Sans cette ligne, nous ne pourrons pas connecter d'internautes à leurs espaces membres plus tard.
//Session_start() permettra en effet de maintenir (et ne pas perdre) l'internaute connecté au site web 
//même s'il navigue de page en page.
session_start();
 
//CHEMIN => (Au lieu d'écrire "site_vetement", on écrit RACINE_SITE. Cette initialisation nous permettra
// en cas de changement de chemin, de ne faire qu'une seule modification ici même. RACINE_SITE prendra automatiquement
// sa valeur)
define("RACINE_SITE","/site_vetement/");
 
//$contenu = ''; est une variable initialisée à vide pour éviter d'avoir des erreurs undefined
//si jamais nous tentons de l'afficher.
// Nous nous en servirons pour retenir des messages que nous devrions adresser à l'internaute, 
//cela nous permettra de faire 1 affichage global de tous nos éventuels messages à un endroit précis 
$contenu = '';
 
//AUTRES INCLUSIONS
require_once("fonction.inc.php");