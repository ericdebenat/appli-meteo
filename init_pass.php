<?php

session_start();

require_once ('dao.php');

$pass_not_match = "";

if (isset($_GET['token'])) {
	$token = $_GET['token'];
	if (isset($_POST['pass1']))  {
		if ($_POST['pass1'] == $_POST['pass2']) {
			$db = new DAO();
			$db->connect();
			$db->resetPassword($_POST['pass1'], $token);
			header('Location: index.php');
		}
		else {
			$pass_not_match = "Les mots de passe ne correspondent pas";
		}
	}
}
else {
	header('Location: index.php');
}


require_once ('init_pass.html');