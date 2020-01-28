<?php

require "sqlconnexion.php";

if (is_string($_POST['titre']) && is_string($_POST['description']) && is_string($_POST['question1']) && is_string($_POST['option1']) ){
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $question = "";
    $option = "";
   $nbOption=1;
   $nbQuestion=1;
    while(isset($_POST['question'.$nbQuestion]))
    {
        $nbOption=1;
        $question.= $_POST['question'.$nbQuestion].'SEPAR';
        if ($nbQuestion == 1){
            $option.= 'SEPARQUEST';
            $option.= 'SEPAROPTION';
            while(isset($_POST['option'.$nbOption]))
            {
                $option.= $_POST['option'.$nbOption].'SEPAROPTION';
                $nbOption+=1;
            }
            $nbOption = 1;
        } else {
            $option.= 'SEPARQUEST';
            $option.= 'SEPAROPTION';
            while(isset($_POST['option'.$nbQuestion.$nbOption]) )
            {
                $option.= $_POST['option'.$nbQuestion.$nbOption].'SEPAROPTION';
                $nbOption+=1;
            }
            $nbOption = 1;

        }
        $nbQuestion +=1;
    }

}

$add_questionnaire= $bdd->prepare('INSERT INTO questionnaire( titre,description, question, lesoptions, date) VALUES (:titre,:description, :question, :options,NOW()) ');

$add_questionnaire->bindValue('titre', $titre, PDO::PARAM_STR);
$add_questionnaire->bindValue('description', $description, PDO::PARAM_STR);
$add_questionnaire->bindValue('question', $question, PDO::PARAM_STR);
$add_questionnaire->bindValue('options', $option, PDO::PARAM_STR);

$add_questionnaire->execute();

$add_questionnaire->closeCursor();

header("location: pageForms.php")


?>