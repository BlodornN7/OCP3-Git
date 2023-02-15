<?php

require('src/model.php');

session_start();

 if ($_SESSION['logged_in'] !== true) {
	  header ('location: login.php');
	  exit; }
 
require('templates/homepage.php');
?>