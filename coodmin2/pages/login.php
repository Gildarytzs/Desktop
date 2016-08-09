<?php 
require "../init.php";
login($_POST['email'], $_POST['password']);
header('Location: index.php');