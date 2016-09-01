<?php include "header.php"; ?>

<!-- Dépot -->

<div id="new-bid" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header background-purple white-color">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Nouvelle enchère</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <?php
                            if (isset($_POST['title']) && isset($_POST['descriptive']) && isset($_POST['estimatedPrice']) && isset($_POST['miniPrice']) && (isset($_POST['dateD']) || isset($_POST['dateH']) || isset($_POST['dateM']))) {

                                $image['name'] = null;
                                if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                                    $image = $_FILES['image'];
                                    $taille_maxi = 1000000;
                                    $taille = filesize($_FILES['image']['tmp_name']);
                                    $extensions = array('.png', '.jpg', '.jpeg');
                                    $extension = strrchr($_FILES['image']['name'], '.'); 
                                    //Début des vérifications de sécurité...
                                    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                                    {
                                        $erreur = 'Vous devez uploader un fichier de type png, jpg ou jpeg.';
                                    }
                                    if($taille>$taille_maxi)
                                    {
                                        $erreur = 'Le fichier est trop gros...';
                                    }

                                    if($erreur){
                                        echo $erreur;
                                        exit;
                                    }
                                }

                                if (isset($_SESSION['errorBid'])) {
                                    foreach($_SESSION['errorBid'] as $error) {
                                        echo '<p><span class="glyphicon glyphicon-exclamation-sign"></span> ';
                                        
                                    }
                                    unset($_SESSION['errorBid']);
                                    echo '<script>alert("Votre enchère a rencontré des problèmes.")</script>';
                                } else {
                                    $date = (intval($_POST['dateD']) * 24 * 3600) + (intval($_POST['dateH']) * 3600) + (intval($_POST['dateM']) * 60);
                                    $dateEnd = $date + time();
                                    $dateEnd = date("Y-m-d H:i:s", $dateEnd);
                                    
                                    $bdd = connectBdd();
                                    $query = $bdd->prepare('INSERT INTO bids (title, descriptive, category, estimated_price, mini_price, duration_bid, end_bid, seller, image) VALUES (:title, :descriptive, :category, :estimated_price, :mini_price, :duration_bid, :end_bid, :seller, :image)');
                                    $query->execute(["title" => $_POST['title'],
                                                     "descriptive" => $_POST['descriptive'], 
                                                     "category" => $_POST['category'],
                                                     "estimated_price" => $_POST['estimatedPrice'],
                                                     "mini_price" => $_POST['miniPrice'], 
                                                     "duration_bid" => $date,
                                                     "end_bid" => $dateEnd,
                                                     "seller" => $_SESSION['id'],
                                                     "image" => $image['name']]);

                                    if($image['name'] != null) {
                                        $insertedId = $bdd->lastInsertId();
                                        mkdir('../img/'.$insertedId);
                                        move_uploaded_file($image['tmp_name'], '../img/'.$insertedId.'/'.$image['name']);
                                    }
                                    echo '<script>alert("Votre enchère a bien été pris en compte. Elle sera disponible une fois etudiée/validée.")</script>';
                                }
                            }
                            ?>
                            <div class="progress">
                                <div id="progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                            <div id="error_sub" class="has-error" style="display: none;"></div>
                            <form role="form" class="form-horizontal" method="post" action="sub.php" enctype="multipart/form-data">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="alert9" data-toggle="tooltip" data-placement="bottom" title="Le titre doit faire au moins 2 caractères.">
                                                <input type="text" class="form-control" onblur="validateInput('title', 9)" id="title" name="title" value="<?php echo (isset($_POST['title'])?$_POST['title']:"") ?>" placeholder="Titre :">
                                            </div>
                                            <div class="form-group" id="alert10" data-toggle="tooltip" data-placement="bottom" title="Le descriptif doit faire au moins 20 caractères.">
                                                <textarea class="form-control" rows="5" onblur="validateInput('descriptive', 10)" id="descriptive" name="descriptive" placeholder="Descriptif :"><?php echo (isset($_POST['descriptive'])?$_POST['descriptive']:"") ?></textarea>
                                            </div>
                                            <div class="form-group" id="alert11" data-toggle="tooltip" data-placement="bottom" title="Vous devez choisir au moins une catégorie.">
                                                <select class="form-control" onblur="validateInput('category', 11)" id="category" name="category" value="<?php echo(isset($_POST['category'])?$_POST['category']:"") ?>">
                                                    <?php
                                                    if (isset($_POST['category'])) $knowCategory = dataSelect("*", "categories", "id", $_POST['category'], 0); 
                                                       
                                                    if (!isset($_POST['category'])) echo '<option selected="selected">...</option>';
                                                    else {
                                                        echo '<option selected="selected" value="'. $knowCategory['id'] .'">'. $knowCategory['name'] .'</option>';
                                                    }
                                                    $categories = dataSelectAll("*", "categories");  
                                                    if (isset($_POST['category'])) echo '<option>...</option>';
                                                    foreach ($categories as $categorie) {
                                                        if ($_POST['category'] != $categorie['id']) echo '<option value="'. $categorie['id'] .'" class="form-control" onblur="validateInput(\'category\', 5)">'. $categorie['name'] .'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group" id="alert12" data-toggle="tooltip" data-placement="bottom" title="Le prix estimé doit etre supérieur à 0.">
                                                            <input type="text" class="form-control" onblur="validateInput('estimated-price', 12)" id="estimated-price" name="estimatedPrice" value="<?php echo (isset($_POST['estimatedPrice'])?$_POST['estimatedPrice']:"") ?>" placeholder="Prix estimé :">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Euro(s).</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group" id="alert13" data-toggle="tooltip" data-placement="bottom" title="Le prix minimum doit etre supérieur à 0.">
                                                            <input type="text" class="form-control" onblur="validateInput('mini-price', 13)" id="mini-price" name="miniPrice" value="<?php echo (isset($_POST['miniPrice'])?$_POST['miniPrice']:"") ?>" placeholder="Prix minimum :">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Euro(s).</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-center">Durée de l'enchère (minimum 1 minute) : </p>
                                            <div id="date" class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-10">
                                                                    <div class="form-group" id="alert14" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 14)" id="date-d" name="dateD" value="<?php echo (isset($_POST['dateD'])?$_POST['dateD']:"") ?>" placeholder="00">
                                                                    </div> Jour(s)
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-10">
                                                                    <div class="form-group" id="alert15" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours.">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 15)" id="date-h" name="dateH" value="<?php echo (isset($_POST['dateH'])?$_POST['dateH']:"") ?>" placeholder="00">
                                                                    </div> Heure(s)
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 text-center">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-10">
                                                                    <div class="form-group" id="alert16" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours.">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 16)" id="date-m" name="dateM" value="<?php echo (isset($_POST['dateM'])?$_POST['dateM']:"") ?>" placeholder="00">
                                                                    </div> Minute(s)
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" name="image">
                                            </div>
                                            <div class="mt text-center">
                                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-open orange-color"></span> Déposer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Connexion -->

<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center background-purple white-color">
                <h4  class="modal-title white-color"><span  class="glyphicon glyphicon-off orange-color"></span> Connexion</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" class="form-horizontal" method="post" action="login.php" id="formulaire_login">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:"") ?>" placeholder="Email :" id="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Mot de passe :" id="password">
                                    </div>
                                    
                                    <div class="text-center padding">
                                        <p>Pas encore inscrit ? <a class="page-scroll" href="#inscription" data-dismiss="modal">Cliquez ici</a></p>
                                    </div>
                                    <div id="error_login" class="has-error" style="display: none;"></div><!-- a refaire -->
                                    <div class="text-center">
                                        <div class="form-group">
                                            <button id="button" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off orange-color"></span> Connexion</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove orange-color"></span> Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Affichage annonce -->
<container-bid></container-bid>

<!-- Affichage annonce terminée -->

<div id="bids" class="container-fluid text-center">
    <div class="row">
        <h2 class="mb text-center">Enchères terminées</h2>
        <div class="col-md-2"></div>
        <?php
        $bids = dataSelectAll("*", "bids");
        foreach ($bids as $b) {
            $bid = dataSelect("*", "bids", "id", $b['id'], 0);
            $delay = $bid['end_bid'] - time();
            if ($delay < 0 && time() < $bid['end_bid'] + 10800) {
                $seconds = abs($delay % 60);
                $minutes = abs($delay / 60 % 60);
                $hours = abs($delay / 3600 % 24);
                echo '<div class="col-md-2">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading background-orange">';
                echo '<h2>'. $bid['title'] .'</h2>';
                echo '</div>';
                echo '<div class="panel-body">';
                echo '<p><img class="img-responsive" src="'. $bid['image'] .'" alt="'. $bid['title'] .'"></p>';
                echo '<p>'. html_entity_decode($bid['descriptive']) .'</p>';
                echo '</div>';
                echo '</div></div>';
            }
        }
        ?>
        <div class="col-md-2"></div>
    </div>
</div>

<!-- Inscription -->

<div id="inscription" class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php
            if (isset($_POST['type']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerif'])) {
                $_POST['surname'] = ucfirst(strtolower(trim($_POST['surname'])));
                $_POST['name'] = ucfirst(strtolower(trim($_POST['name'])));
                $_POST['pseudo'] = ucfirst(strtolower(trim($_POST['pseudo'])));
                $_POST['email'] = strtolower(trim($_POST['email']));

                validatorSurname($_POST['surname']);
                validatorName($_POST['name']);
                validatorEmail($_POST['email']);
                validatorPseudo($_POST['pseudo']);
                validatorPassword($_POST['password'], $_POST['passwordVerif']);
                if (!isset($_POST['cgu'])) $_SESSION['errors'][] = 7;

                if (isset($_SESSION['errors'])) {
                    foreach($_SESSION['errors'] as $error) {
                        echo '<p><span class="glyphicon glyphicon-exclamation-sign"></span> ';
                        echo $listOfErrorsSubscribe[$error] .'</p>';
                    }
                    unset($_SESSION['errors']);
                    echo '<script>alert("Votre inscription a rencontré des problèmes. Veuillez re-cliquer sur Inscription pour voir les problèmes et les corriger.")</script>';
                } else {
                    $bdd = connectBdd();
                    $access_token = md5(uniqid());
                    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = $bdd->prepare('INSERT INTO users (type, surname, name, pseudo, email, tel, password, access_token) VALUES (:type, :surname, :name, :pseudo, :email, :tel, :password, :access_token)');
                    $query->execute(["type" => $_POST['type'],
                                     "surname" => $_POST['surname'], 
                                     "name" => $_POST['name'],
                                     "pseudo" => $_POST['pseudo'], 
                                     "email" => $_POST['email'],
                                     "tel" => $_POST['tel'],
                                     "password" => $pwd, 
                                     "access_token" => $access_token]);
                    echo '<script>alert("Votre inscription a bien été pris en compte. Vous pouvez maintenant vous connecter.")</script>';
                }
            }
            ?>
            <h2 class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Inscription</h2>
            <div id="error_sub" class="has-error" style="display: none;"></div>
            <form role="form" class="form-horizontal" method="post" id='formulaire_subscribe'>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="alert0" data-toggle="tooltip" data-placement="bottom" title="Veuillez choisir une civilité">
                                <select class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s" onblur="validateInput('type', 0)" id="type" name="type" value="<?php echo(isset($_POST['type'])?$_POST['type']:"") ?>">
                                    <option selected="selected">...</option>
                                    <option>Mr.</option>
                                    <option>Mme.</option>
                                    <option>Mlle.</option>
                                </select>
                            </div>
                            <div class="form-group" id="alert1" data-toggle="tooltip" data-placement="bottom" title="Le prénom doit faire plus de  2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s" onblur="validateInput('surname', 1)" id="surname" name="surname" value="<?php echo (isset($_POST['surname'])?$_POST['surname']:"") ?>" placeholder="Prénom :">
                            </div>
                            <div class="form-group" id="alert2" data-toggle="tooltip" data-placement="bottom" title="Le nom doit faire plus de  2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" onblur="validateInput('name', 2)" id="name" name="name" value="<?php echo (isset($_POST['name'])?$_POST['name']:"") ?>" placeholder="Nom :">
                            </div>
                            <div class="form-group" id="alert8" data-toggle="tooltip" data-placement="bottom" title="Le pseudo doit faire plus de  2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.2s" onblur="validateInput('pseudo', 8)" id="pseudo" name="pseudo" value="<?php echo (isset($_POST['pseudo'])?$_POST['pseudo']:"") ?>" placeholder="Pseudo :">
                            </div>
                            <div class="form-group" id="alert3" data-toggle="tooltip" data-placement="bottom" title="L'email doit être valide.">
                                <input type="email" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.4s" onblur="validateInput('email', 3)" id="email" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:"") ?>" placeholder="Email :">
                            </div>
                            <div class="form-group" id="alert4" data-toggle="tooltip" data-placement="bottom" title="Le téléphone doit être valide.">
                                <input type="tel" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.6s" onblur="validateInput('tel', 4)" id="tel" name="tel" value="<?php echo (isset($_POST['tel'])?$_POST['tel']:"") ?>" placeholder="Téléphone :">
                            </div>
                            <div class="form-group" id="alert5" data-toggle="tooltip" data-placement="bottom" title="Le mot de passe doit contenir entre 8 et 12 caractères.">
                                <input type="password" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.8s" onblur="validateInput('password', 5)" id="password" name="password" placeholder="Mot de passe :">
                            </div>
                            <div class="form-group" id="alert6" data-toggle="tooltip" data-placement="bottom" title="La vérification doit correspondre au mot de passe.">
                                <input type="password" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s" onblur="validateInput('passwordVerif', 6)" id="passwordVerif" name="passwordVerif" placeholder="Vérification :">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <div class="checkbox wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.2s">
                                <input type="checkbox" name="cgu" onclick="validateInput('cgu', 7)" id="cgu"> Validation des <a href="">CGU</a><br><br>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.4s">
                                <p>Renseigner tous les champs pour pouvoir cliquer sur ce bouton.</p>
                                <button id="buttonFinal" type="submit" class="btn btn-default" disabled><span class="glyphicon glyphicon-open orange-color"></span> Inscription</button>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include "footer.php"; ?>