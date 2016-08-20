<?php 
require "../init.php";

if(isset($_POST['email']) && isset($_POST['password'])) {

	if(login($_POST['email'], $_POST['password'])){
		print_r(TRUE);
	}else{
		print_r('Identifiants incorrects');
	}
} else {
	print_r('Identifiants incorrects');
}