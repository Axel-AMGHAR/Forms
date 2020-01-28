<?php

try
{
    $bdd = new PDO('mysql:host=mysql-axelamghar.alwaysdata.net;dbname=axelamghar_form;charset=utf8', '167450_user', 'user');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>