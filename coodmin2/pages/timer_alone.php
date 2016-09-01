<?php

require "../init.php";
$maxprice=0;

$bdd = connectBdd();
$query = $bdd->prepare('SELECT bids.id AS bid_id, bids.title, bids.estimated_price, bids.descriptive, bids.image, bids.end_bid, bids.category, users.email, users.tel, users.pseudo, users.type, users.id AS user_id, users.surname, users.name, bid_user.bet_money, categories.name AS category_name
						FROM bids
						LEFT JOIN users ON users.id = bids.seller
						LEFT JOIN categories ON categories.id = bids.category
						LEFT JOIN bid_user ON bid_user.id_bid = bids.id
						WHERE bids.id = '.$_GET['id']);
$query->execute();
$bid = $query->fetch();

$query = $bdd->prepare('SELECT commentaire.id, commentaire.timer, commentaire.comment, users.surname, users.name
						FROM commentaire
						LEFT JOIN users ON users.id = commentaire.id_user
						WHERE commentaire.id_bid = '.$_GET['id']);
$query->execute();
$bid['commentaire'] = $query->fetchAll();

print_r(json_encode($bid));