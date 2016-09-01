<?php

require "../init.php";

$id_bid = $_GET['id'];
$comment = $_POST['comment'];
$id_user = $_SESSION['id'];
$timer=time();
$timer = date("d-m-Y H:i", $timer);
$bdd = connectBdd();
$query = $bdd->prepare('INSERT INTO commentaire SET id_bid = :id_bid, id_user = :id_user, comment = :comment, timer= :timer');
$query->execute(['id_bid' => $id_bid, 'id_user' => $id_user, 'comment' => $comment, 'timer' => $timer]);

header('Location: bid.php?id=' . $id_bid);
