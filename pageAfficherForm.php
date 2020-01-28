    <?php
include "session.php";
include "header.php";
require "sqlconnexion.php";
include "recupQuestions+Options.php";

?>

<div class ="conteneur">
    <form method="post" action="gestionResultat.php" id="form2">
        <div style="border-radius: 4px;
             border: solid #45ADED;
             border-width: 4px 4px;
              padding: 10px;
              margin-bottom: 12px;
">
            <h1><?php echo $donnees['titre']?> </h1>
            <p><?php echo $donnees['description']?></p>
        </div>
        <?php foreach ($allOpt as $element){

        ?> <div class="form-group vueDeRes" style=" border: solid #724DAE;border-width: 2px 2px;border-radius: 4px;padding: 12px;">
            <label><b> <?php echo $questions[$nb];
               ?></b></label><br/>
            <?php

        foreach ($element as $op){
            ?><div class="form-check">
                <input class="form-check-input" type="radio" name="question<?php echo $nb?>" id="exampleRadios<?php echo $new?>" value="<?php echo $op?>" required>
                <label class="form-check-label" for="exampleRadios<?php echo $new?>">
                    <?php echo $op?>
                </label>
            </div>
            <?php
            $new+=1;
        }
        echo '</div>';
        $nb+=1;
    }?>
            <div class="alignerRight">
                <button type="submit" id="buttonEnvoyer" form="form2">Envoyer </button>
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>
</div>
