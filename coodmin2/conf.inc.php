<?php
define('USERBDD', 'root');
define('MDPBDD', 'root');
define('HOSTBDD', 'localhost');
define('NAMEBDD', 'coodmin');

$listOfErrorsSubscribe = [1 => "Le prénom doit faire plus de 2 caractères.", 
						  2 => "Le nom doit faire plus de 2 caractères.", 
						  3 => "L'email n'est pas valide.", 
						  4 => "L'email est déjà utilisé.", 
						  5 => "Le mot de passe doit faire entre 8 et 12 caractères.", 
						  6 => "La vérification doit correspondre au mot de passe.", 
						  7 => "Les Conditions Générales d'Utilisation doivent être acceptées.",
						  8 => "Le pseudo doit faire plus de 2 caractères."];
$listOfErrorsLogin = [1 => "Vous devez confirmer votre inscription.", 
					  2 => "L'email ou le mot de passe est incorrect."];
$listOfErrorsBid = [1 => "Le titre doit faire plus de 2 caractères.", 
				    2 => "Le descriptif doit faire plus de 20 caractères.",
                    3 => "Le prix estimé doit être supérieur à 0€.",
                    4 => "Le prix minimum doit être supérieur à 0€.",
                    5 => "La durée de l'enchère doit être supérieure à 1 minute et inférieure à 60 jours.",
                    6 => "Vous devez choisir au moins une catégorie"];