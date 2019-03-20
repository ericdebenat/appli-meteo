<?php
	session_start();
	
	if (isset($_SESSION["connected"]) && $_SESSION["connected"]==false) {
		$connectError="Vérifiez vos identifiants de connexion";
	}
	else {
		$connectError="";
	}

	if (isset($_SESSION["email_checked"]) && $_SESSION["email_checked"]==true) {
		$connectError="Un email de réinitialisation de mot de passe vous a été envoyé";
	}
	else {
		$connectError="";
	}

	if (isset($_SESSION["user_name_error"]) && $_SESSION["user_name_error"]==true) {
		$userError="Cet identifiant existe déjà";
	}
	else {
		$userError="";
	}

	if (isset($_SESSION["email_error"]) && $_SESSION["email_error"]==true) {
		$emailError="Cet email est déjà associé à un compte";
	}
	else {
		$emailError="";
	}

	if (isset($_SESSION["pass_error"]) && $_SESSION["pass_error"]==true) {
		$passError="Les mots de passe ne correspondent pas";
	}
	else {
		$passError="";
	}
	
	unset($_SESSION["user"]);
	unset($_SESSION["connected"]);
	unset($_SESSION["user_name_error"]);
	unset($_SESSION["pass_error"]);
	unset($_SESSION["email_error"]);
	unset($_SESSION["email_checked"]);


	require_once("connect_form.html");


