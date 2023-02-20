<?php error_reporting(0); //ignore les erreurs non pertinentes ?>
<!DOCTYPE html>

<html>
  <head>
    <title>Récupération du mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/connexion.css">
  </head>
  <body>



<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=gbaf_database;charset=utf8', 'root', 'root');
}

catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')   {
    $username = $_POST['username'];
    $SecretAnswer = $_POST['SecretAnswer'];

$CheckUsernameAndSecretAnswerSQL = $db->prepare('SELECT * FROM users WHERE username = :username AND reponse = :reponse');
$CheckUsernameAndSecretAnswerSQL->bindParam(':username', $username);
$CheckUsernameAndSecretAnswerSQL->bindParam(':reponse', $SecretAnswer);
$CheckUsernameAndSecretAnswerSQL->execute();
$user = $CheckUsernameAndSecretAnswerSQL->fetch();
    if ($user["username"] === $username && $user["reponse"] === $SecretAnswer) {
    header('location: PasswordModification.php');
    }
    
    else {echo '<section id="incorrect">

        <div class="formulaire">

            Identifiants incorrects
            <br> 
            <a href="Passwordreset.php">Revenir à la page</a>
        </div>

        </section>';}
}


else { include_once('header.php'); ?>
    
    <section>
         <div id="formulaire_inscription"> 
<h1 style="text-align: center;">Mot de passe oublié</h1>

<form action="Passwordreset.php" method="POST">
	<input type="text" id="username" name="username" placeholder="Nom d'utilisateur"><br>
	<input type="text" id="SecretAnswer" name="SecretAnswer" placeholder="Réponse à la question secrète"><br>
	<button type="submit" value="Modifier le mot de passe"><strong>Modifier le mot de passe</strong></form>
</div>
       
</section>


<?php include_once('footer.php');

 }


?>
        