<?php require "../init.php"; 

dataDelete("bids","id",$_GET['id']);
header("Location: admin.php");