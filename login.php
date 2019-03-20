<?php
	session_start();
	
	require_once('dao.php');
	$db = new DAO();
	$db->connect();
	$user = $db->user($_POST['login']);
	$password = $db->password($_POST['login']);
	
	
	if (($_POST["login"] == $user) && (md5($_POST["password"]) == $password)) {
		$_SESSION["connected"]=true;
		$_SESSION["user"] = $_POST["login"];
		header("Location:meteo.php");
	}
	else {
		$_SESSION["connected"]=false;
		header("Location:index.php");
	}
