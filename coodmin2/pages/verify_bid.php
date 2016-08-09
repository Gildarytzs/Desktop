<?php require "../init.php"; 

dataModify("bids","verified","id",$_GET['id'],1);
$bids = dataSelect("duration_bid","bids","id",$_GET['id'],0);
$date_end = time() + $bids['duration_bid'];
dataModify("bids","end_bid","id",$_GET['id'],$date_end);

header("Location: admin.php");