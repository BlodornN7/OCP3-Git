<?php session_start(); ?>

<?php if ($_SESSION['logged_in'] !== true) {
	header ('location: login.php');
	exit;
}
?>

<?php 
$id = $_GET['id']; 
require('src/model.php');
foreach($Acteur as $Acteurs) {
if ($id == $Acteurs['id_acteur']) {
    require('templates/Acteurs.php');

}};



 ?>