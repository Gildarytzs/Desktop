<?php

require "../init.php";

$bdd = connectBdd();
$query = $bdd->prepare('SELECT bids.title, bids.estimated_price, bids.descriptive, bids.image, bids.end_bid, bids.category, users.email, users.tel, users.pseudo,users.type, users.id, users.surname, users.name, categories.name AS category_name
						FROM bids
						LEFT JOIN users ON users.id = bids.seller
						LEFT JOIN categories ON categories.id = bids.category');
$query->execute();
$bid = $query->fetchAll();

print_r(json_encode($bid));