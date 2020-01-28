<?php
session_start();

//regarde si les deux champs sont remplis
if (isset($_POST['name']) && isset($_POST['pass'])) {
    $login = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['pass']);
}

//si déja connécté
if (isset($_SESSION['user']))
{
    header('location: pageForms.php');
}
else {
    require "sqlconnexion.php";
}

/* Requête pour récupérer les enregistrements répondant à la clause : champ du pseudo et champ du mdp de la table = pseudo et mdp posté dans le formulaire */
$connexion= $bdd->prepare("SELECT * FROM connexion WHERE name = :nom AND pass = :password");
$connexion->execute(array(
    'nom'=> $login,
    'password'=> $password
));

$donnees = $connexion->fetchAll();

$result = count($donnees);
if ($result == 1){
    $_SESSION['user'] = $login;
    header('Location: pageForms.php');
}


$connexion->closeCursor();


include "header.php";
include "gestionLogin.php";
include "footer.html";

?>

