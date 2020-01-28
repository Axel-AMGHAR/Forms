<?php
include "session.php";
include "header.php";
?>

<div class ="conteneur">

    <form method="post" action="gestionForm1.php" id="monForm">
        <input type="text" class="titre"  placeholder="Titre du questionnaire à choix multiples" name="titre" required><br />
        <textarea type="text" class="description"  placeholder="Description du questionnaire" name="description" required></textarea>
        <br />

        <div class="row" id="questions">

            <div class="inputNextToButton" id="question1" >
                <div id="removeButtonQuestion1">
                    <input type="text" class="inputPourTitreQuestion"  placeholder="Question 1 sans titre" name="question1" required>
                    <button  onmouseover="afficherTexte(this,'Ajouter une question')" onmouseout="enleverTexte()" type="button"  class="btsListe" id="ajout-question1"><img  height="20" width="20" src="images/+.png"/></button><br />
                </div>
                <div id ="removeButton1">
                    <input type="text" class="inputPourForm" id="option1"  placeholder="Option1" name="option1" required>
                    <button type="button" onmouseover="afficherTexte(this,'Ajouter une option')" onmouseout="enleverTexte()" class="btsListe" id="ajout-option11"><img  height="20" width="20" src="images/options.png"/></button>
                </div>
            </div>
        </div>

        <div class="alignerRight">
            <button type="submit" id="buttonEnvoyer" form="monForm">Envoyer</button>
        </div>
    </form>
</div>

<script type="text/javascript">

        //affiche et supprime un texte au passage de la souris sur les différents buttons bouton

        const afficherTexte = (x, texte) => {
            x.insertAdjacentHTML("beforeEnd", '<span id="suppr"><b>' + texte + '</b><span>');
        };

        const enleverTexte = () => {
            document.getElementById("suppr").parentNode.removeChild(document.getElementById("suppr"));
        };


        //ajoute une option

        let buttonOption = document.getElementById("ajout-option11");
        let nbOptions = 1;

        const gestionButton = () => {
            let option = document.getElementById("question1");
            nbOptions += 1;
            if (nbOptions > 5) {
                if (nbOptions > 9)
                {
                    alert("vous ne pouvez pas dépasser 9 options");
                    console.log("vous ne pouvez pas dépasser 9 options");
                    return 0;
                }
                let nbOpt = nbOptions - 1;
                let tailleNbOptions = prompt("êtes vous sur de vouloir mettre plus de " + nbOpt + " options O/N");

                if (tailleNbOptions !== 'O') {
                    return 0;
                }

            }
            option.insertAdjacentHTML("beforeEnd", ' <div id="removeButton'+nbOptions+'"> '+
                ' <input type="text" class="inputPourForm" id="option'+nbOptions+'"  placeholder="Option'+nbOptions+'" name="option'+nbOptions+'" >'+
                '<button type="button" onmouseover="afficherTexte(this,\'Supprimer cette option\')" onmouseout="enleverTexte()" class="btsListe " id ="supprimer-option'+nbOptions+'"><img  height="20" width="20" src="images/been.png"/></button>'+
                ' <button type="button" onmouseover="afficherTexte(this,\'Ajouter une option\')" onmouseout="enleverTexte()" class="btsListe2" id="ajout-option1'+nbOptions+'"><img  height="20" width="20" src="images/options.png"/></button><br />' +
                '</div>');

            let nbOpts=nbOptions-1;
            let buttonToDelete = document.getElementById("removeButton"+nbOpts);
            if (nbOpts === 1){
                buttonToDelete.removeChild(buttonToDelete.childNodes[3]);
            } else {
                buttonToDelete.removeChild(buttonToDelete.childNodes[4]);
            }

            let buttonOptio = document.getElementById("ajout-option1"+nbOptions);
            buttonOptio.addEventListener("click", gestionButton);

            //partie a supprimer
            let buttonSupprimer= document.getElementById("supprimer-option"+nbOptions);

            buttonSupprimer.onclick = function () {
                let idEltButtton = this.getAttribute('id');
            }
        };

        buttonOption.addEventListener("click", gestionButton);


        //permet de naviguer entre les éléments pour savoir sur quel question il se trouve

        let nbQuestions = 1;
        let positionOfQuestion = 1; //la position sur laquelle l'utilisateur à cliqué pour la derniére fois
        let emplacementQuestion = document.getElementById("question1");

        emplacementQuestion.addEventListener("click", () => {
            let emplacementQuestions = document.getElementById("question1");
            let style = getComputedStyle(emplacementQuestions);
            if (style.backgroundColor !== "rgb(229, 165, 251)") {
                for (let i=1;i<= nbQuestions;i++)
                {
                    let place = document.getElementById("question"+i);
                    let rmvStyle = place.style;
                    rmvStyle.background = "white";
                    rmvStyle.borderRadius= 0+"px";
                    rmvStyle.padding = 0+"px";
                    rmvStyle.margin = 0+"%";
                    rmvStyle.boxShadow= 0+"px "+0+"px "+0+"px "+ "white";
                }
                let addStyle = emplacementQuestions.style;
                addStyle.backgroundColor = "#E5A5FB";
                addStyle.borderRadius= 2+"px";
                addStyle.padding = 4+"px";
                addStyle.margin = 2+"%";
                addStyle.boxShadow= 2+"px "+2+"px "+12+"px "+ "#4B3966";

                positionOfQuestion=1;
            }
        });




        //ajouter une question

        let boutonQuestion = document.getElementById("ajout-question1");

        const gestionButtonQuestion = () => {

            let questions = document.getElementById("questions");
            nbQuestions += 1;
            if (nbQuestions > 5) {
                if (nbQuestions > 9)
                {
                    alert("vous ne pouvez pas dépasser 9 questions");
                    console.log("vous ne pouvez pas dépasser 9 questions");
                    return 0;
                }
                    let nbQst = nbQuestions - 1;
                    let tailleNbQuestions = prompt("êtes vous sur de vouloir mettre plus de " + nbQst + " questions O/N");


                    if (tailleNbQuestions !== 'O') {
                        return 0;
                    }

            }
            questions.insertAdjacentHTML("beforeEnd", '<div class="inputNextToButton" id="question' + nbQuestions + '" >\n' +
                '                <div id="removeButtonQuestion' + nbQuestions + '">\n' +
                '                    <input type="text" class="inputPourTitreQuestion"  placeholder="Question ' + nbQuestions + ' sans titre" name="question' + nbQuestions + '" required>\n' +
                '                    <button  onmouseover="afficherTexte(this,\'Ajouter une question\')" onmouseout="enleverTexte()" type="button"  class="btsListe" id="ajout-question' + nbQuestions + '"><img  height="20" width="20" src="images/+.png"/></button><br />\n' +
                '                </div>\n' +
                '                <div id ="removeButton' + nbQuestions + '1">\n' +
                '                    <input type="text" class="inputPourForm" id="option' + nbQuestions + '1"  placeholder="Option' + 1 + '" name="option' + nbQuestions + '1" required>\n' +
                '                    <button type="button" onmouseover="afficherTexte(this,\'Ajouter une option\')" onmouseout="enleverTexte()" class="btsListe" id="ajout-option' + nbQuestions + "1" + '"><img  height="20" width="20" src="images/options.png"/></button>\n' +
                '                </div>\n' +
                '            </div>');


            let nbQue = nbQuestions - 1;
            let questionPre = document.getElementById("ajout-question" + nbQue);
            document.getElementById("removeButtonQuestion" + nbQue).removeChild(questionPre);

            document.getElementById('question' + nbQuestions).onclick = function () {

                var idElt = this.getAttribute('id');
                emplacementQuestion = document.getElementById(idElt);
                let style = getComputedStyle(emplacementQuestion);
                if (style.backgroundColor !== "rgb(229, 165, 251)") {
                    for (let i = 1; i <= nbQuestions; i++) {
                        let place = document.getElementById("question" + i);
                        let rmvStyle = place.style;
                        rmvStyle.background = "white";
                        rmvStyle.borderRadius = 0 + "px";
                        rmvStyle.padding = 0 + "px";
                        rmvStyle.margin = 0 + "%";
                        rmvStyle.boxShadow = 0 + "px " + 0 + "px " + 0 + "px " + "white";

                    }
                    let addStyle = emplacementQuestion.style;
                    addStyle.backgroundColor = "#E5A5FB";
                    addStyle.borderRadius = 2 + "px";
                    addStyle.padding = 4 + "px";
                    addStyle.margin = 2 + "%";
                    addStyle.boxShadow = 2 + "px " + 2 + "px " + 12 + "px " + "#4B3966";
                }
            };

            let boutonQuestio = document.getElementById("ajout-question" + nbQuestions);
            boutonQuestio.addEventListener("click", gestionButtonQuestion);


            let newButtonOption = document.getElementById("ajout-option" + nbQuestions + "1");


            //gestions des options pour les questions suivantes
                newButtonOption.onclick = function optionEnBoucle () {

                    let id = this.getAttribute("id");
                    let posAdd = Number(id[13]) + 1;
                    let position = id[12] + posAdd;

                    let option = document.getElementById(id).parentNode.parentNode;

                    let realNb = Number(id[13]) + 1;
                    if (realNb > 5) {
                        if (realNb > 9)
                        {
                            alert("vous ne pouvez pas dépasser 9 options");
                            console.log("vous ne pouvez pas dépasser 9 options");
                            return 0;
                        } else {
                            let numberToShow = realNb - 1;
                            let tailleNbOptions = prompt("êtes vous sur de vouloir mettre plus de " + numberToShow + " options O/N");

                            if (tailleNbOptions !== 'O')
                                return 0;
                        }

                    }
                    option.insertAdjacentHTML("beforeEnd", ' <div id="removeButton' + position + '"> ' +
                        ' <input type="text" class="inputPourForm" id="option' + position + '"  placeholder="Option' + realNb + '" name="option' + position + '">' +
                        '<button type="button" onmouseover="afficherTexte(this,\'Supprimer cette option\')" onmouseout="enleverTexte()" class="btsListe " id ="supprimer-option' + position + '"><img  height="20" width="20" src="images/been.png"/></button>' +
                        ' <button type="button" onmouseover="afficherTexte(this,\'Ajouter une option\')" onmouseout="enleverTexte()" class="btsListe2" id="ajout-option' + position + '"><img  height="20" width="20" src="images/options.png"/></button><br />' +
                        '</div>');


                    let posPrec = id[12] + id[13];
                    let buttonToDelete = document.getElementById("removeButton" + posPrec);
                    if (realNb === 2) {
                        console.log(realNb);
                        buttonToDelete.removeChild(buttonToDelete.childNodes[3]);
                        console.log(buttonToDelete.childNodes[3]);
                    } else {
                        buttonToDelete.removeChild(buttonToDelete.childNodes[4]);
                    }

                    let buttonOptio = document.getElementById("ajout-option" + position);
                    buttonOptio.addEventListener("click", optionEnBoucle);

                    //partie a supprimer
                    let buttonSupprimer = document.getElementById("supprimer-option" + position);

                    buttonSupprimer.onclick = function () {
                        let idEltButtton = this.getAttribute('id');
                    }
                }


        };


        boutonQuestion.addEventListener("click", gestionButtonQuestion);

</script>
<?php
include "footer.html";
?>
