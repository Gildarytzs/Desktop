<?php 
require "../init.php";

if (isset($_POST['title']) && isset($_POST['descriptive']) && isset($_POST['estimatedPrice']) && isset($_POST['miniPrice']) && (isset($_POST['dateD']) || isset($_POST['dateH']) || isset($_POST['dateM']))) {

	validatorTitle($_POST['title']);
    validatorDescriptive($_POST['descriptive']);
    validatorCategory($_POST['category']);
    validatorEstimatedPrice($_POST['estimatedPrice']);
    validatorMiniPrice($_POST['miniPrice']);
    validatorDate($_POST['dateD'], $_POST['dateM'], $_POST['dateH']);
    if (isset($_SESSION['errorBid'])) {
        foreach($_SESSION['errorBid'] as $error) {
            
            echo $listOfErrorsBid[$error];
        }
      }

     }