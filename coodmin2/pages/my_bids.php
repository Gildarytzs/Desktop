<?php require "header.php"; ?>

<div id="bids" class="container-fluid">
    <div class="row">
        <h2 class="mb text-center">Mes enchères</h2>
        <div class="col-md-2"></div>
        <?php
        $bids = dataSelectAll("*", "bids");
        foreach ($bids as $b) {
            $bid = dataSelect("*", "bids", "id", $b['id'], 0);
            $user = dataSelect("*", "users", "id", $bid['seller'], 0);
            $bidUser = dataSelect("*", "bid_user", "id_bid", $bid['id'], 1);
            $bidUser = array_reverse($bidUser);
            $delay = $bid['end_bid'] - time();
            $verified = $bid['verified'];
            if ($delay > 0 && $verified == 1 && $bid['seller'] == $_SESSION['id']) {
                $seconds = $delay % 60;
                $minutes = $delay / 60 % 60;
                $hours = $delay / 3600 % 24;
                echo '<div class="col-md-3">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading background-orange">';
                echo $bid['title'];
                echo '</div>';
                echo '<div class="panel-body">';
                echo '<div class="container-fluid">';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<p><img class="img-responsive" onload="count()" src="'. $bid['image'] .'" alt="'. $bid['title'] .'"></p>';
                echo '</div>';
                echo '<div class="col-md-6">';
                if (empty($bidUser)) echo '<p>0€</p>';
                else echo '<p>'. $bidUser[0]['bet_money'] .'€</p>';
                echo '<button type="button" class="btn btn-default">Miser</button>';
                echo '<p>'. html_entity_decode($bid['descriptive']) .'</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="panel-footer text-center background-orange">';
                echo '<p id="counter"><span class="glyphicon glyphicon-time"></span> '. ($hours < 10 ? '0'. $hours : $hours) .' : '. ($minutes < 10 ? '0'. $minutes : $minutes) .' : '. ($seconds < 10 ? '0'. $seconds : $seconds) .'</p>';
                echo '</div></div></div>';
            }
        }
        ?>
        <div class="col-md-2"></div>
    </div>
</div>

<div id="bids2" class="container-fluid text-center">
    <div class="row">
        <h2 class="mb text-center">Toutes mes enchères terminées</h2>
        <div class="col-md-2"></div>
        <?php
        $bids = dataSelectAll("*", "bids");
        foreach ($bids as $b) {
            $bid = dataSelect("*", "bids", "id", $b['id'], 0);
            $user = dataSelect("*", "users", "id", $bid['seller'], 0);
            $delay = $bid['end_bid'] - time();
            if ($delay < 0 &&  $bid['seller'] == $_SESSION['id']) {
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
                echo '</div><div class="panel-footer background-orange">';
                echo '<p>Terminée depuis : '. ($hours < 10 ? '0'. $hours : $hours) .' : '. ($minutes < 10 ? '0'. $minutes : $minutes) .' : '. ($seconds < 10 ? '0'. $seconds : $seconds) .'</p>';
                echo '</div></div></div>';
            }
        }
        ?>
        <div class="col-md-2"></div>
    </div>
</div>

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
                                $_POST['title'] = ucfirst(strtolower(trim($_POST['title'])));
                                $_POST['descriptive'] = ucfirst(strtolower(trim(htmlentities($_POST['descriptive']))));

                                validatorTitle($_POST['title']);
                                validatorDescriptive($_POST['descriptive']);
                                validatorCategory($_POST['category']);
                                validatorEstimatedPrice($_POST['estimatedPrice']);
                                validatorMiniPrice($_POST['miniPrice']);
                                validatorDate($_POST['dateD'], $_POST['dateM'], $_POST['dateH']);

                                if (isset($_SESSION['errorBid'])) {
                                    foreach($_SESSION['errorBid'] as $error) {
                                        echo '<p><span class="glyphicon glyphicon-exclamation-sign"></span> ';
                                        echo $listOfErrorsBid[$error] .'</p>';
                                    }
                                    unset($_SESSION['errorBid']);
                                    echo '<script>alert("Votre enchère a rencontré des problèmes. Veuillez re-cliquer sur \"Déposer une enchère\" pour voir les problèmes et les corriger.")</script>';
                                } else {
                                    $date = (intval($_POST['dateD']) * 24 * 3600) + (intval($_POST['dateH']) * 3600) + (intval($_POST['dateM']) * 60);
                                    $dateEnd = $date + time();
                                    $bdd = connectBdd();
                                    $query = $bdd->prepare('INSERT INTO bids (title, descriptive, category, estimated_price, mini_price, duration_bid, end_bid, seller) VALUES (:title, :descriptive, :category, :estimated_price, :mini_price, :duration_bid, :end_bid, :seller)');
                                    $query->execute(["title" => $_POST['title'],
                                                     "descriptive" => $_POST['descriptive'], 
                                                     "category" => $_POST['category'],
                                                     "estimated_price" => $_POST['estimatedPrice'],
                                                     "mini_price" => $_POST['miniPrice'], 
                                                     "duration_bid" => $date,
                                                     "end_bid" => $dateEnd,
                                                     "seller" => $_SESSION['id']]);
                                    echo '<script>alert("Votre enchère a bien été pris en compte. Elle sera disponible une fois etudiée/validée.")</script>';
                                }
                            }
                            ?>
                            <div class="progress">
                                <div id="progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                            <form role="form" class="form-horizontal" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="alert1" data-toggle="tooltip" data-placement="bottom" title="Le titre doit faire au moins 2 caractères.">
                                                <input type="text" class="form-control" onblur="validateInput('title', 1)" id="title" name="title" value="<?php echo (isset($_POST['title'])?$_POST['title']:"") ?>" placeholder="Titre :">
                                            </div>
                                            <div class="form-group" id="alert2" data-toggle="tooltip" data-placement="bottom" title="Le descriptif doit faire au moins 20 caractères.">
                                                <textarea class="form-control" rows="5" onblur="validateInput('descriptive', 2)" id="descriptive" name="descriptive" placeholder="Descriptif :"><?php echo (isset($_POST['descriptive'])?$_POST['descriptive']:"") ?></textarea>
                                            </div>
                                            <div class="form-group" id="alert5" data-toggle="tooltip" data-placement="bottom" title="Vous devez choisir au moins une catégorie.">
                                                <select class="form-control" onblur="validateInput('category', 5)" id="category" name="category" value="<?php echo(isset($_POST['category'])?$_POST['category']:"") ?>">
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
                                                        <div class="form-group" id="alert3" data-toggle="tooltip" data-placement="bottom" title="Le prix estimé doit etre supérieur à 0.">
                                                            <input type="text" class="form-control" onblur="validateInput('estimated-price', 3)" id="estimated-price" name="estimatedPrice" value="<?php echo (isset($_POST['estimatedPrice'])?$_POST['estimatedPrice']:"") ?>" placeholder="Prix estimé :">
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
                                                        <div class="form-group" id="alert4" data-toggle="tooltip" data-placement="bottom" title="Le prix minimum doit etre supérieur à 0.">
                                                            <input type="text" class="form-control" onblur="validateInput('mini-price', 4)" id="mini-price" name="miniPrice" value="<?php echo (isset($_POST['miniPrice'])?$_POST['miniPrice']:"") ?>" placeholder="Prix minimum :">
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
                                                                    <div class="form-group" id="alert6" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 6)" id="date-d" name="dateD" value="<?php echo (isset($_POST['dateD'])?$_POST['dateD']:"") ?>" placeholder="00">
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
                                                                    <div class="form-group" id="alert7" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours.">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 7)" id="date-h" name="dateH" value="<?php echo (isset($_POST['dateH'])?$_POST['dateH']:"") ?>" placeholder="00">
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
                                                                    <div class="form-group" id="alert8" data-toggle="tooltip" data-placement="bottom" title="La durée de l'enchère doit être supérieur à 1 minute et inférieur à 60 jours.">
                                                                        <input type="text" class="form-control" onblur="validateInput('date', 8)" id="date-m" name="dateM" value="<?php echo (isset($_POST['dateM'])?$_POST['dateM']:"") ?>" placeholder="00">
                                                                    </div> Minute(s)
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                Inserer image(s)
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