<?php require "../init.php"; ?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coodmin</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/animate.css">
    </head>
    <body>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container-fluid background-purple">
                
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Coodmin</a>
                </div>
                
                <ul class="nav navbar-nav">
                    <?php
                    
                    if (isConnected()) {
                        $dddd=dataSelect("id","users","id",$_SESSION['id'],0);
                        echo '<li><a href="index.php">Accueil</a></li>';
                        echo '<li><a href="bids.php">Enchères</a></li>';
                        echo '<li><a data-toggle="modal" data-target="#new-bid">Déposer une enchère</a></li>';
                        if ( $dddd['id'] == 0) {
                        echo '<li><a href="admin.php">Admin</a></li>';
                    }
                        echo "<li><a href='mails.php'>Messages</a></li>";
                        
                    } else {
                        echo '<li><a href="index.php">Accueil</a></li>';
                        echo '<li><a href="bids.php">Enchères</a></li>';   
                    }
                    ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isConnected()) {
                        $dddd=dataSelect("*","users","id",$_SESSION['id'],0);
                        echo '<li>Bonjour '. $dddd['surname'].'</li>';
                        echo '<li><a href="my_bids.php">Mes enchères</a></li>';
                        echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off orange-color"></span> Déconnexion</a></li>';
                    } else {
                        echo '<li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-off orange-color"></span> Connexion</a></li>';
                    }
                    ?>
                </ul>
                
            </div>
        </nav>

