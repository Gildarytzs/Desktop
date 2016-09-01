<?php include "header.php"; ?>

<div id="bids" class="container-fluid text-center">

	<recherche-component></recherche-component>

	<template id="template-recherche">
		<h1>Categories</h1>
		<span v-for="category in categories">
			<category-component :category.sync="category"></category-component>
		</span>
		<div v-for="bid in bids">
			<bid bid="bid"></bid>
		</div>
	</template>

	<template id="template-category">
		<input type="checkbox" id="{{ category.id }}" @click="checkCategory"><label for="{{ category.id }}">{{ category.name }}</label>
	</template>

</div>

<?php include "footer.php";?>