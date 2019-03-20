<?php

	session_start();
	
	
	require_once("dao.php");
	
	require_once 'vendor/autoload.php';

	function email_send($email) {
		// Create the Transport
		$transport = (new Swift_SmtpTransport('smtp.###.com', 465, 'ssl'))
		  ->setUsername('###')
		  ->setPassword('###')
		;

		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$message = (new Swift_Message('Réinitialisation du mot de passe'))
		  ->setFrom(['###' => 'Appli Météo'])
		  ->setTo([$email, ''])
		  ->setBody("<a href='http://deerweb.fr/demo/meteo/init_pass.php?token=".md5($email)."'>Cliquez ici pour réinitialiser le mot de passe</a>")
		  ;

		// Send the message
		$result = $mailer->send($message);
	}
	
	$db = new DAO();
	$db->connect();
	$email_not_found = '';
	
	if (isset($_GET['action']) && $_GET['action'] == 'check') {
		if ($db->checkEmail($_POST['email'])) {
			$_SESSION['email_checked']=true;
			email_send($_POST['email']);
			header('Location:index.php');
		}
		else {
			$_SESSION['email_checked']=false;
			$email_not_found = 'Cet email n\'existe pas dans notre base de données';
		}
	}
	require_once("forget_pass.html");
