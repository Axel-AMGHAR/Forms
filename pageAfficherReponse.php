<?php
include "session.php";
include "header.php";
require "sqlconnexion.php";
include "recupQuestions+Options.php";

$recupValues = $bdd->prepare ('SELECT nbReponse,realid,option1,option2,option3,option4,option5 FROM reponse where realid=:id');
$recupValues->bindValue('id', $id, PDO::PARAM_INT);
$recupValues->execute();

$donnees=$recupValues->fetchAll();

$newQuestionnaires = $bdd->prepare('SELECT id, titre,description,question, lesoptions,date FROM questionnaire where id =:id ');

$newQuestionnaires->bindValue('id', $id, PDO::PARAM_INT);
$newQuestionnaires->execute();
$newQ=$newQuestionnaires->fetchAll();
$l=1;
$calculOpts = array();
foreach ($donnees as $key => $newElem) {
    foreach ($allOpt as $element) {

        $newDelim = "SEPAR";
        $caclulOptions = explode($newDelim, $newElem['option' . $l]);
        $newSize = count($caclulOptions);

        $j=0;
        foreach ($element as $op) {
            if ($caclulOptions[$j] != "") {
                $calculOpts[$l][$j] = $caclulOptions[$j];

            }
            $j++;
        }
        $l++;
    }
}

foreach ($newQ as $key => $newEle) {
    foreach ($donnees as $key2 => $nbRep) {

?>

<div class="conteneur">
    <form method="post" action="gestionResultat.php" id="form2">
        <div style="border-radius: 4px;border: solid #45ADED;border-width: 4px 4px;padding: 12px;margin-bottom: 10px;">
            <h1><?php echo $newEle['titre']; ?> </h1>
            <p><?php echo $newEle['description']; ?></p>
            <p><?php echo 'Nombre de réponse(s) : ' . $nbRep['nbReponse']; ?></p>
        </div>
        <?php
        $o = 1;
        foreach ($allOpt as $element){
        ?>
        <div class="form-group vueDeRes"
             style=" border: solid #724DAE;border-width: 2px 2px;border-radius: 4px;padding: 12px;">
            <label><b> <?php echo $questions[$nb]; ?></b></label><br/>
            <?php
            $n = 0;
            foreach ($element as $op) {
                ?>
                <div class="form-check">
                    <label style="  border: solid #724DAE;
                            border-width: 2px 2px;
                            border-radius: 110px;
                            padding: 2%;
                            background: linear-gradient(to right, #ECA8CB, #ECA8CB <?php echo round($calculOpts[$o][$n], 1); ?>%, #eee 1%);
                            margin-right: 40px;">
                        <?php echo round($calculOpts[$o][$n], 2) . " %"; ?>
                    </label>
                    <label class="form-check-label" for="exampleRadios<?php echo $new ?>">
                        <?php echo $op . " "; ?>
                    </label>
                </div>
                <?php
                $new += 1;
                $n += 1;
            }
            echo '</div>';
            $nb += 1;
            $o += 1;
            }?>
                </form>
</div>



        <?php
        }
    }

$_dejaDansLaTable = $bdd->prepare('SELECT COUNT(*) FROM reponse WHERE  realid=:id;');
$_dejaDansLaTable->bindValue('id', $id, PDO::PARAM_INT);
$_dejaDansLaTable->execute();

$donneeId = $_dejaDansLaTable->fetch();

if ($donneeId["COUNT(*)"] != '1'){
?>
    <div class="conteneur">
        <div class="alert alert-danger" role="alert">
             Personne n'a répondu au questionaire pour le moment
        </div>
    </div>
    <?php
}


