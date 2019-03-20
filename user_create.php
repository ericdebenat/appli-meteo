<?php
	session_start();
	
	require_once('dao.php');
	
	$db = new DAO();
	$db->connect();
	
	if ($db->checkUsers($_POST['user_name'])) {
		$_SESSION['user_name_error']=true;
	}
	else {
		$_SESSION['user_name_error']=false;
	}
	
	if ($db->checkEmail($_POST['email'])) {
		$_SESSION['email_error']=true;
	}
	else {
		$_SESSION['email_error']=false;
	}
	
	if (md5($_POST['pass1']) == md5($_POST['pass2'])) {
		
		$_SESSION['pass_error']=false;
	}
	else {
		$_SESSION['pass_error']=true;
	}
	
	if ($_SESSION['user_name_error'] == false && $_SESSION['pass_error'] == false && $_SESSION['email_error'] == false) {
		$db->userCreate($_POST['user_name'], $_POST['email'], $_POST['pass1']);
	}
	
	header('Location: index.php');
?>