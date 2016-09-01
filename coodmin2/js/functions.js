var know = 0;
var count = 0;

function validateInput(id, num) {
	count = 0;
	var input = document.getElementById(id).value;
	var div = document.getElementById("alert" + num);
	var progress = document.getElementById("progress");
	var inputButton = document.getElementById("buttonFinal");

	if(id == "type") {
		if (input != "...") {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";  // seul qui marche 
				count += 12;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 12;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "surname") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "name") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
				else {
					div.className = "form-group danger";
					count -= 11;
					progress.style.width = count + "%";
					progress.setAttribute("aria-valuenow", count);
					progress.innerHTML = count + "%";
				}
			}
		}
	} else if (id == "pseudo") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
				else {
					div.className = "form-group danger";
					count -= 11;
					progress.style.width = count + "%";
					progress.setAttribute("aria-valuenow", count);
					progress.innerHTML = count + "%";
				}
			}
		}
	} else if (id == "email") {
		var reggex = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		
		if (reggex.test(input)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
			console.log(div.className);
		}
	} else if (id == "tel") {
		var reggex = new RegExp("0[1-9]([.-_ ]?[0-9]{2}){4}");
		
		if (reggex.test(input)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "password") {
		if (input.length > 8 && input.length < 12) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "passwordVerif") {
		var inputPassword = document.getElementById("password").value;
		
		if ((inputPassword == input) && (input.length > 8 && input.length < 12)) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 11;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "cgu") {
		var inputBis = document.getElementById(id);
		
		if (input == "on") {
			if (inputBis.getAttribute("class") == "check") {
				count -= 11;
				inputBis.removeAttribute("class");
			} else {
				count += 11;
				inputBis.setAttribute("class", "check");
			}
			progress.style.width = count + "%";
			progress.setAttribute("aria-valuenow", count);
			progress.innerHTML = count + "%";
		}
	} else if (id == "title") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "descriptive") {
		if (input.length > 2) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "estimated-price") {
		if (input > 0) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "mini-price") {
		if (input > 0) {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 20;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	} else if (id == "date") {
        var inputDateD = document.getElementById("date-d").value;
        var inputDateH = document.getElementById("date-h").value;
        var inputDateM = document.getElementById("date-m").value;
		if (((inputDateD > 0 && inputDateD < 61) || (inputDateH > 0 && inputDateH < 25) || (inputDateM > 0 && inputDateM < 61))) {
            if (know == 0) count += 15;
            know = 1;
            progress.style.width = count + "%";
            progress.setAttribute("aria-valuenow", count);
            progress.innerHTML = count + "%";
		} else {
            if (know == 1) count -= 15;
            know = 0;
            progress.style.width = count + "%";
            progress.setAttribute("aria-valuenow", count);
            progress.innerHTML = count + "%";
		}
	} else if (id == "category") {
		if (input != "...") {
			if (div.className == "form-group" || div.className == "form-group danger") {
				div.className = "form-group success";
				count += 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		} else {
			if (div.className == "form-group" || div.className == "form-group danger") div.className = "form-group danger";
			else {
				div.className = "form-group danger";
				count -= 15;
				progress.style.width = count + "%";
				progress.setAttribute("aria-valuenow", count);
				progress.innerHTML = count + "%";
			}
		}
	}
	if (count == 100) {
		progress.setAttribute("class", "progress-bar progress-bar-success progress-bar-striped active");
		inputButton.removeAttribute("disabled");
	} else {
		progress.setAttribute("class", "progress-bar progress-bar-warning progress-bar-striped active");
		inputButton.setAttribute("disabled", true);
	}
}

function count() {
    var counter = document.getElementById("counter");
}

jQuery(function($) {

	$("#formulaire_login").submit(function(e) {
		e.preventDefault();

		$.ajax({
			method: 'POST',
			url: '../pages/login.php',
			data: {
				'email': $('#email').val(),
				'password': $('#password').val()
			},
			success: function(data) {
				if(data == 1) {
					location.reload();
				} else {
					$("#error_login").append(data).show();
				}
			}
		});
	});

	$("#formulaire_subscribe").submit(function(e) {
		e.preventDefault();

		$.ajax({
			method: 'POST',
			url: '../pages/sub.php',
			data: {
				'type': $('#alert0').val(),
				'surname': $('#alert1').val(),
				'name': $('#alert2').val(),
				'pseudo': $('#alert8').val(),
				'email': $('#alert3').val(),
				'tel': $('#alert4').val(),
				'password': $('#alert5').val(),
				'passwordVerif': $('#alert6').val(),
				'cgu': $('#alert7').val(),
			},
			success: function(data) {
				if(data == 1) {
					location.reload();
				} else {
					$("#error_sub").append(data).show();
				}
			}
		});
	});

});

Vue.http.options.root = '/coodmin2';
Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';

// index.php
var Bid = Vue.extend({
	props: ['bid'],
	data: function() {
		var self = this;
		return {
			tmp: ''
		}
	},
	computed: {
		src: function() {
			if(this.bid.image != null){
				return '../img/' + this.bid.id + '/' + this.bid.image;
			} else {
				return '../img/bids/' + this.bid.category + '.jpg';
			}
		}
	},
	created: function() {
		this.timelaps();
	},
	methods: {
		timelaps: function() {
			var restant = new Date(this.bid.end_bid).getTime() - Date.now();
			var jours=parseInt(restant/86400000);
			var hours=parseInt((restant%86400000)/3600000);
			var minutes=parseInt((restant%3600000)/60000);
			var secondes=parseInt((restant%60000)/1000);
			if(jours < 0 || hours < 0 || minutes < 0 || secondes < 0) {
				this.tmp = 'Enchère terminée.';
			} else {
				this.tmp = jours + ' jour(s) ' + hours + 'h ' + minutes + 'min ' + secondes + 's';
			}
			setTimeout(this.timelaps, 1000);
		},
	},
	template: `
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading background-orange">
                            <a href="bid.php?id={{ bid.id }}">{{ bid.title }}</a>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><img class="img-responsive" onload="count()" v-bind:src="src" alt="{{ bid.title }}"></p>
                                    </div>
                                    <div class="col-md-5">
                                    	<p><b>Prix estime par le vendeur</b> {{ bid.estimated_price }} Euros</p>
                                        <a href="bid.php?id={{ bid.id }}"><button type="button" class="btn btn-default">Miser</button></a>
                                        <p>{{ bid.descriptive }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center background-orange">
                            <p id="counter"><span class="glyphicon glyphicon-time"></span> {{ tmp }}</p>
                        </div>
                    </div>
                </div>`
});

var ContainerBid = Vue.extend({
	data: function() {
		return {bids: ''}
	},
	components: {
		'bid': Bid
	},
	created: function() {
		self = this;
	  	this.$http.get('pages/timer.php').then((response) => {
	      	self.bids = JSON.parse(response.data);
	  	}, (response) => {
	      	console.log(response);
	  	});
	 },
	template: `<div id="bids" class="container-fluid">
				    <div class="row">
				        <h2 class="mb text-center">Enchères en cours</h2>
				        <div class="col-md-2"></div>
						<div v-for="bid in bids">
							<bid :bid="bid"></bid>
						</div>
						<div class="col-md-2"></div>
				    </div>
				</div>`
});

// bid.php
var BidAlone = Vue.extend({
	data: function() {
		return {
			bid: '',
			tmp: ''
		}
	},
	computed: {
		src: function() {
			if(this.bid.image != null){
				return '../img/' + this.bid.bid_id + '/' + this.bid.image;
			} else {
				return '../img/bids/' + this.bid.category + '.jpg';
			}
		}
	},
	created: function() {
		self = this;
	  	this.$http.post('pages/timer_alone.php?id=' + window.id_bid).then((response) => {
	      	self.bid = JSON.parse(response.data);
	      	this.timelaps();
	  	}, (response) => {
	      	console.log(response);
	  	});
	},
	methods: {
		timelaps: function() {
			var restant = new Date(this.bid.end_bid).getTime() - Date.now();
			var jours=parseInt(restant/86400000);
			var hours=parseInt((restant%86400000)/3600000);
			var minutes=parseInt((restant%3600000)/60000);
			var secondes=parseInt((restant%60000)/1000);
			this.tmp = jours + ' jour(s) ' + hours + 'h ' + minutes + 'min ' + secondes + 's';
			setTimeout(this.timelaps, 1000);
		},
	},

	template: `
                <div id="bids" class="container-fluid">
                	<div class="col-md-8">
					<h2 class='text-center'><b>{{ bid.title }}</b></h2>
					<span>{{ bid.type + ' ' + bid.surname + ' ' + bid.name }}</span><br>
					<span><b>Categorie</b> : {{ bid.category_name }}</span>
					<div class="col-md-3">
						<img class="img-responsive" v-bind:src="src" alt="{{ bid.title }}">
					</div>
					<p><b>Prix estime par le vendeur</b> {{ bid.estimated_price }} Euros</p>
					<form method="post" action="mise.php?id={{ bid.id_bid }} ">
						<input type="number" name="mise"
						>
						<button type="submit">Encherir</button>
					</form>
					<p><b>Mise qui pourrait win</b> :{{ bid.bet_money }} Euros</p>
					<br></br>
					<h3>{{ bid.descriptive }}</h3>
					<br></br>
					</div>
					<div class="col-md-4">
                     <p> Detail sur {{ bid.pseudo }}</p>
					<b>Email</b> : {{ bid.email }} <b>Numero de telephone</b> : {{ bid.tel }}
                      </div>
					
					
				</div>
				<div class="panel-footer text-center background-orange col-md-4">
                        <p id="counter"><span class="glyphicon glyphicon-time"></span> {{ tmp }}</p>
                 </div>

                 <form method="post" action="comment.php?id={{ bid.bid_id }}">
						<textarea name="comment"></textarea><br><br>
						<button type="submit">Commenter</button>
				</form>
				
				<li v-for="commentaire in bid.commentaire">
                	<b>{{ commentaire.surname }} {{ commentaire.name }}</b>: {{ commentaire.comment }}  <i>A  {{ commentaire.timer }}</i>
                </li>
				
						
				<br><br>
				`
});

var BidAllmine = Vue.extend({
	data: function() {
		return {bids: ''}
	},
	components: {
		'bid': Bid
	},
	created: function() {
		self = this;
	  	this.$http.post('pages/allmybids.php').then((response) => {
	      	self.bids = JSON.parse(response.data);
	      	this.timelaps();
	  	}, (response) => {
	      	console.log(response);
	  	});
	 },
	template: `<div id="bids" class="container-fluid">
				    <div class="row">
				        <h2 class="mb text-center">Mes encheres</h2>
				        <div class="col-md-2"></div>
						<div v-for="bid in bids">
							<bid :bid="bid"></bid>
						</div>
						<div class="col-md-2"></div>
				    </div>
				</div>`
});

// Recherche
var categoryComponent = Vue.extend({
	template: '#template-category',
	props: ['category'],
	methods: {
		checkCategory: function() {
			this.category.checked = ! this.category.checked;
			this.$parent.doRecherche();
		}
	}
});

var RechercheComponent = Vue.extend({
	template: '#template-recherche',
	data: function() {
		return {categories: [
				{id: '1', name: 'Véhicule', checked: false},
				{id: '2', name: 'Immobilier', checked: false},
				{id: '3', name: 'Multimédia', checked: false},
				{id: '4', name: 'Maison', checked: false},
				{id: '5', name: 'Loisirs', checked: false},
				{id: '6', name: 'Autres', checked: false}
			],
			bids: ''};
	},
	methods: {
		doRecherche: function() {
			var categories_de_recherche = this.categories.filter(function(category) {
				return category.checked;
			}).map(function(category) {
				return category.id;
			});

			if(categories_de_recherche.length > 0) {
				self = this;
			  	this.$http.post('pages/recherche.php', {categories_de_recherche: categories_de_recherche}, {emulateJSON: true}).then((response) => {
			      	self.bids = JSON.parse(response.data);
			  	}, (response) => {
			      	console.log(response);
			  	});
			} else {
				this.bids = '';
			}
		}
	},
	components: {
		'category-component': categoryComponent,
		'bid': Bid
	}
});
// Fin Recherche

new Vue({
	el: "body",
	components: {
		'container-bid': ContainerBid,
		'bid-alone': BidAlone,
		'bid-allmine' : BidAllmine,
		'recherche-component': RechercheComponent
	}
});