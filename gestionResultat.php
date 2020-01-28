<?php
include "session.php";
require "sqlconnexion.php";
include "recupQuestions+Options.php";
header("location: pageAfficherReponse.php?id=$id");

$_dejaDansLaTable = $bdd->prepare('SELECT COUNT(*) FROM reponse WHERE  realid=:id;');
$_dejaDansLaTable->bindValue('id', $id, PDO::PARAM_INT);
$_dejaDansLaTable->execute();

$donneeId = $_dejaDansLaTable->fetch();


//si la ligne est déja dans la base de donnée
if ( $donneeId['COUNT(*)'] == '1'){

    $recupValues = $bdd->prepare ('SELECT nbReponse,realid,option1,option2,option3,option4,option5 FROM reponse where realid=:id');
    $recupValues->bindValue('id', $id, PDO::PARAM_INT);
    $recupValues->execute();
    $newReponses=0;

    $values=$recupValues->fetchAll();

    //ajoute 1 à la valeur du nb de réponses
    $newReponses=0;
    foreach ( $values as $key => $element)
    {
        $newReponses= $element["nbReponse"];
        $newReponses+=1;

    }


    $envoyer_reponse = $bdd->prepare('UPDATE reponse set nbReponse=:nbReponse,option1=:option1,option2=:option2,option3=:option3,option4=:option4,option5=:option5 WHERE realid=:id');
    $envoyer_reponse->bindValue('nbReponse', $newReponses, PDO::PARAM_INT);
    $envoyer_reponse->bindValue('id', $id, PDO::PARAM_INT);

    $i=0;
    $j=1;
    while ($i<5) {

        $envoyer_reponse->bindValue('option'.$j,"", PDO::PARAM_STR);
        $i++;
        $j++;

    }

    $i=0;
    $j=1;
    $l=1;

    $eachOption = array();
    $optionArray= array();
    foreach ( $values as $key => $elem)
    {
        foreach ($allOpt as $element) {
            $nboption = "";

            $eachOption[$l]= $elem["option".$l];

            $delimiter="SEPAR";
            $optionExplode = explode($delimiter,$eachOption[$l]);
            $tailleArray=count($optionExplode);
            $k= 0;

            foreach ($element as $op){
                if ($optionExplode[$k] != "")
                {
                    $optionArray[$k] = $optionExplode[$k];
                }
                $question[$i] = $_POST['question'.$i];
                echo ($optionArray[$k].'<br/>'.$question[$i]).'//'.$op.'<br/>';
                $oper =count($op);
                if ($question[$i] == $op )
                {

                    $newRep =$newReponses-1;
                    $add=(intval($optionArray[$k])*($newRep/$newReponses))+(100*(1/$newReponses));

                    $nboption .= $add;
                    $nboption.="SEPAR";
                } else {
                    $newRep =$newReponses-1;
                    echo $newRep.'t';
                    $rmv = (intval($optionArray[$k])*($newRep/$newReponses));
                    $nboption .= $rmv;
                    $nboption.="SEPAR";
                }
                $k++;
            }
            $l++;
            $i++;
            echo ('option'.$i.$nboption);
            $envoyer_reponse->bindValue('option'.$i, $nboption, PDO::PARAM_STR);
        }
        $envoyer_reponse->execute();
        $envoyer_reponse->closeCursor();

    }




    //si c'est la premiére fois que l'on envoit une réponse,crée la ligne
} else {
    $nbReponse=1;
    $envoyer_reponse = $bdd->prepare('INSERT INTO reponse (nbReponse,realid,option1,option2,option3,option4,option5) values (:nbReponse,:realid,:option1,:option2,:option3,:option4,:option5)');
    $envoyer_reponse->bindValue('nbReponse', $nbReponse, PDO::PARAM_INT);
    $envoyer_reponse->bindValue('realid', $id, PDO::PARAM_INT);

    $i=0;
    $j=1;
    while ($i<5) {

        $envoyer_reponse->bindValue('option'.$j,"", PDO::PARAM_STR);
        $i++;
        $j++;

    }

    $i=0;
    $j=1;

    foreach ($allOpt as $element) {

        $nboption = "";
        foreach ($element as $op){
            $question[$i] = $_POST['question'.$i];

                if ($question[$i] == $op )
                {
                    $nboption .= 100;
                    $nboption.="SEPAR";
                } else {
                    $nboption .= 0;
                    $nboption.="SEPAR";
                }

        }
        $i++;

        $envoyer_reponse->bindValue('option'.$i, $nboption, PDO::PARAM_STR);
    }

    $envoyer_reponse->execute();
    $envoyer_reponse->closeCursor();

}

?>