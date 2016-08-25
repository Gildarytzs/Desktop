<?php include "header.php"; ?>

<?php

	$bid = dataSelect('*', 'bids', 'id', $_GET['id'], 0);
	$user = dataSelect("*", "users", "id", $bid['seller'], 0);

?>

<div id="bids" class="container-fluid">
	<h2><?= $user['pseudo'] ?> vend <?= $bid['title'] ?></h2>
	<img class="img-responsive" src="<?= $bid['image'] ?>" alt="<?= $bid['title'] ?>">
	<h3><?= html_entity_decode($bid['descriptive']) ?></h3>
</div>

<?php include "footer.php"; ?>
