<!DOCTYPE html>

<html>
  <head>
    <title>Nouveau mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>




<?php include_once("header.php");
try
{
    $db = new PDO('mysql:host=localhost;dbname=gbaf_database;charset=utf8', 'root', 'root');
}

catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']))  {
    $username = $_POST['username'];
    $newpassword = $_POST['NewPassword'];
    

// Demande à db de mettre à jour le mot de passe de l'utilisateur
$UpdateUserPasswordSQL = $db->prepare('UPDATE users_new SET password = :password WHERE username = :username');
$UpdateUserPasswordSQL->bindParam(':username', $username);
$UpdateUserPasswordSQL->bindParam(':password', $newpassword);
$UpdateUserPasswordSQL->execute();
$passwordupdated = $UpdateUserPasswordSQL;
header('location: login.php');

}
else { ?>

<section>

    <div class="formulaire"> 

<h1>Modification du mot de passe</h1>

        <form method="POST">
        	<input type="text" id="username" name="username" placeholder="Nom d'utilisateur"><br>
            <input type="password" id="NewPassword" name="NewPassword" placeholder="Nouveau mot de passe"><br><br>
            <button type="submit" value="Modifier le mot de passe"><strong>Modifier le mot de passe</strong></button>
        </form>
    
        </br> 

    </div>

</section> 


<?php 

    ;} 

?>

 <?php include_once('footer.php'); ?>

