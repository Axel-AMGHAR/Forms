<?php
if(isset($_GET["id"]))
{
    $id = $_GET["id"];
} else {
   $id = $_POST["id"];
}


$questionnaires = $bdd->prepare('SELECT id, titre,description,question, lesoptions,date FROM questionnaire where id =:id ');

$questionnaires->bindValue('id', $id, PDO::PARAM_INT);
$questionnaires->execute();
$donnees=$questionnaires->fetch();

$delimiter = "SEPAR";
$questions = explode ( $delimiter,$donnees['question']);
$taille = count($questions);

$delimiterQue = "SEPARQUEST";
$delimiterOption = "SEPAROPTION";
$options = explode ( $delimiterQue,$donnees['lesoptions']);
$sizeOp=10;
$size = count($options);

$allOpt = array();
$optNow = array();

for ($i=1;$i<$size; $i++) {
    $option = explode ( $delimiterOption,$options[$i]);
    $sizeOp=count($option);
    for ($j=0;$j<$sizeOp; $j++){
        if ($option[$j] != ""){
            $optNow[$j] = $option[$j];

        }
    }$allOpt[$i] = $optNow;
    for ($j=0;$j<$sizeOp; $j++){
            unset($optNow[$j]);

    }
}


$nb=0;
$new = 1;
?>