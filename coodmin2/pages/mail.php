<?php
	require "init.php";

	if (!isConnected($_SESSION['email'])) {
		header("Location: index.php");
	}
	include "header.php";
?>
		
	
			<a href="newmessage.php">Nouveau Message</a>
			<a href="Mails.php">Boîte de réception</a>
			<a href="sentMail.php">Messages envoyés</a>


	
<?php require "footer.php";?>