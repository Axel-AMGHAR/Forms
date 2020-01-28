<!DOCTYPE html >
<html >
<head>
    <title>Form</title>
    <link rel="icon" href="images/iconeFormGoogle.jpg" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="javascript/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="pageForms.php">Forms <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="form1.php">Créer un questionnaire <span class="sr-only">(current)</span></a>
            </li>

                <?php
                if (!isset($_SESSION['user']))
                {
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inscription</a>
                    </li>
                    <?php
                }else{
                    ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
                <?php
                }
                ?>

    </div>
</nav>