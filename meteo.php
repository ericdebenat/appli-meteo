<?php
	session_start();
	
	if ($_SESSION["connected"]==true) {
		$userName = $_SESSION["user"];
		require_once("data.html");
	}
	else {
		$_SESSION["connected"]=false;
		header('Location: index.php');
	}
