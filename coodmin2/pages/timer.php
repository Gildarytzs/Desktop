<?php

require "../init.php";

$bdd = connectBdd();
$query = $bdd->prepare('SELECT * FROM bids WHERE end_bid > CURRENT_TIMESTAMP AND verified = 1');
$query->execute();
$resultat = $query->fetchAll();
$bids = $resultat;

print_r(json_encode($bids));