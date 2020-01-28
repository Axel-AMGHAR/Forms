<?php
session_start();
include "header.php";
?>

<!--formulaire de connexion / -->

<form  action="login.php" method="post" enctype="multipart/form-data" id="myForm" >

    <div class="connexion ">
        <h3><b>Se connecter</b></h3><br/>

            <div class="input-group">
                <div class="positionInputBase" >
                    <div class="input-group-text inputGroupPrepend3" id ="test"><img class="" src="images/homme.png" width="34px"/></div>
                </div>
                <input type="text" class="input_base" value="user" id="user" placeholder="Username" aria-describedby="inputGroupPrepend3" required name="name">
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        <br/>

            <div class="input-group">
                <div class="positionInputBase">
                    <div class="input-group-text" id="inputGroupPrepend3"><img  src="images/cadenas.png"    width="34px" /></div>
                </div>
                <input type="password" value="user" class="input_base is-invalid" id="password " placeholder="Password" aria-describedby="inputGroupPrepend3" required name="pass">
                <div class="invalid-feedback" id="badPass">
                    Mauvais password.
                </div>
                <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
            </div>
            <br/>
            <input id="buttonConnexion" class="buttonConnexion" type="submit" value="Connexion" />
        </div>




