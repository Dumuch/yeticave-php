<?php
require_once('functions.php');
require_once('data.php');

if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
	header('Location: /index.php');
	exit();
}



