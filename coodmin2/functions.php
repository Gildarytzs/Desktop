<?php

function connectBdd() {
    try {
        $bdd = new PDO('mysql:dbname='.NAMEBDD.';host='.HOSTBDD, USERBDD, MDPBDD);
    } catch(Exception $e) {
        die('Erreur'. $e->getMessage());
    }
    return $bdd;
}

function dataSelect($select, $from, $where, $id, $method) {
	$bdd = connectBdd();
	$query = $bdd->prepare('SELECT '. $select .' FROM '. $from .' WHERE '. $where .' = :id');
	$query->execute(["id" => $id]);
	if ($method == 0) $resultat = $query->fetch();
	else $resultat = $query->fetchAll();
	return $resultat;
}

function dataSelectAll($select, $from) {
	$bdd = connectBdd();
	$query = $bdd->prepare('SELECT '. $select .' FROM '. $from);
	$query->execute();
	$resultat = $query->fetchAll();
	return $resultat;
}

function dataModify($from, $set, $where, $id, $message) {
	$bdd = connectBdd();
    $message = stripslashes(trim($message));
	$query = $bdd->prepare('UPDATE '. $from .' SET '. $set .' = :message WHERE '. $where .' = :id');
	$query->execute(["message" => $message, "id" => $id]);
}

function dataDelete($from, $where, $id) {
	$bdd = connectBdd();
	$query = $bdd->prepare('DELETE FROM '. $from .' WHERE '. $where .' = :id');
	$query->execute(["id" => $id]);
}

function emailExist($email) {
	$resultat = dataSelect("id", "users", "email", $email, 0);
    if (empty($resultat)) return FALSE;
    else return TRUE;
}

function accessTokenExist($access_token) {
	$resultat = dataSelect("id", "users", "access_token", $access_token, 0);
    if (empty($resultat)) return FALSE;
    else return TRUE;
}

function generateAccessToken($email) {
	$access_token = md5(uniqid());
	$bdd = connectBdd();	
	$query = $bdd->prepare('UPDATE users SET access_token = :access_token WHERE email = :email');
	$query->execute(["access_token" => $access_token, "email" => $email]);
	return $access_token;
}

function isConnected() {
	if (!isset($_SESSION['access_token']) || empty($_SESSION['access_token'])) {
		return FALSE;
	}
	$bdd = connectBdd();
	$query = $bdd->prepare('SELECT id FROM users WHERE email = :email AND access_token = :access_token');
	$query->execute(["email" => $_SESSION['email'], "access_token" => $_SESSION['access_token']]);
	$resultat = $query->fetch();
	if (empty($resultat)) {
		return FALSE;
	} else {
		$_SESSION['access_token'] = generateAccessToken($_SESSION['email']);
		return TRUE;
	}
}

function login($email, $password) {
	$resultat = dataSelect("*", "users", "email", $email, 0);
    if ($resultat) {
		if (password_verify($password, $resultat['password'])) {
			$_SESSION['access_token'] = generateAccessToken($email);
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $resultat['id'];
			return FALSE;
		} else {
			$_SESSION['errors'][] = 8; 
			$log = fopen("log.txt", "a+");
			fputs($log, "Email : ". $email ." \ Mot de passe : ". $password ."\r\n");
			fclose($log);
			return TRUE;
		}
    }
}

function logout() {
	session_destroy();
	header('Location: index.php');
}

function validatorSurname($surname) {
	if (strlen($surname) < 3) {
		$_SESSION['errorSubscribe'][] = 1;
		return FALSE;
	}
	return TRUE;
}

function validatorName($name) {
	if (strlen($name) < 3) {
		$_SESSION['errorSubscribe'][] = 2;
		return FALSE;
	}
	return TRUE;
}

function validatorPseudo($pseudo) {
	if (strlen($pseudo) < 3) {
		$_SESSION['errorSubscribe'][] = 8;
		return FALSE;
	}
	return TRUE;
}

function validatorEmail($email) {
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$_SESSION['errorSubscribe'][] = 3;
		return FALSE;
	}
	if (emailExist($_POST['email'])) {
		$_SESSION['errorSubscribe'][] = 4;
		return FALSE;
	}
	return TRUE;
}

function validatorPassword($pwd1, $pwd2) {
	if (strlen($pwd1) < 8 || strlen($pwd1) > 12) {
		$_SESSION['errorSubscribe'][] = 5;
		return FALSE;
	}
	if ($pwd1 != $pwd2) {
		$_SESSION['errorSubscribe'][] = 6;
		return FALSE;
	}
	return TRUE;
}

function validatorTitle($title) {
	if (strlen($title) < 3) {
		$_SESSION['errorBid'][] = 1;
		return FALSE;
	}
	return TRUE;
}

function validatorDescriptive($descriptive) {
	if (strlen($descriptive) < 3) {
		$_SESSION['errorBid'][] = 2;
		return FALSE;
	}
	return TRUE;
}

function validatorCategory($category) {
	if ($_POST['category'] == "...") {
		$_SESSION['errorBid'][] = 6;
		return FALSE;
	}
	return TRUE;
}

function validatorEstimatedPrice($estimatedPrice) {
	if (intval($estimatedPrice) < 1) {
		$_SESSION['errorBid'][] = 3;
		return FALSE;
	}
	return TRUE;
}

function validatorMiniPrice($miniPrice) {
	if (intval($miniPrice) < 1) {
		$_SESSION['errorBid'][] = 4;
		return FALSE;
	}
	return TRUE;
}

function validatorDate($dateD, $dateM, $dateH) {
	if ((intval($dateD) + intval($dateH) + intval($dateM)) < 1 || intval($dateD) > 61 || intval($dateH) > 25 || intval($dateM) > 61) {
		$_SESSION['errorBid'][] = 5;
		return FALSE;
	}
	return TRUE;
}