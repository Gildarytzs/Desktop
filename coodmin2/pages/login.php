<?php 
require "../init.php";

if(isset($_POST['email']) && isset($_POST['password'])) {

	if(login($_POST['email'], $_POST['password'])){
		print_r(TRUE);
	}else{
		print_r("L'email ou le mot de passe est incorrect.");
	}
} else {
	print_r("L'email ou le mot de passe est incorrect.");
}