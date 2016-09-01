<?php

require "../init.php";

$id_bid = $_GET['id'];
$mise = $_POST['mise'];
$id_user = $_SESSION['id'];

$bdd = connectBdd();
$query = $bdd->prepare('INSERT INTO bid_user SET id_bid = :id_bid, id_user = :id_user, bet_money = :bet_money');
$query->execute(['id_bid' => $id_bid, 'id_user' => $id_user, 'bet_money' => $mise]);

header('Location: bid.php?id=' . $id_bid);
