<?php
include "session.php";
include "header.php";
include "sqlconnexion.php";
include "formsHtml.php";

$questionnaires = $bdd->prepare('SELECT id, titre,description,question, lesoptions,date FROM questionnaire GROUP BY id DESC LIMIT 0,7 ');

$questionnaires->execute();

$donnee = $questionnaires->fetchAll();
foreach($donnee as $key => $donnees){

    if (htmlspecialchars($donnees['titre']) == "")
    {
        $donnees['titre'] = "Formulaire sans titre";
    }
    echo '<a href="pageAfficherForm.php?id='.$donnees['id'].'" class="enleverAnimation" ><div class="formFinal" >
               <span><b>'. htmlspecialchars($donnees['titre']) .'</b></span><br/>
               <span><img class="imgForm" src="images/iconeFormGoogle.jpg"> Créé le ' . htmlspecialchars($donnees['date']) . '</span>'.
          '</div></a>';
}
?>
</div>
</div><br/>
    <div id ="formRecent">
         <p><b>Voir les résultats </b></p>
        <div class="row">
            <?php
            foreach($donnee as $key => $donnees){

            if (htmlspecialchars($donnees['titre']) == "")
                $donnees['titre'] = "Formulaire sans titre";
            echo '<a href="pageAfficherReponse.php?id='.$donnees['id'].'" class="enleverAnimation" ><div class="formFinal" >
                    <span><b>'. htmlspecialchars($donnees['titre']) .'</b></span><br/>
                    <span><img class="imgForm" src="images/iconeFormGoogle.jpg"> Créé le ' . htmlspecialchars($donnees['date']) . '</span>
                </div></a>';
            }
            ?>
        </div>
    </div>
</div>

<script>

    //enléve l'animation du lien
    let supprAnim = document.getElementsByClassName("enleverAnimation");

    for(const suppr of supprAnim){
        suppr.style.color = "black";
        suppr.onmouseover = function () {
            suppr.style.textDecoration = "none";
        }
    }



</script>
<?php
include "footer.html";
?>


