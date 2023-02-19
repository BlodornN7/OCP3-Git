<!DOCTYPE html>

<html>
  <head>
    <title>Page d'inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/connexion.css">
  </head>
  <body>

       <?php include_once('header.php'); ?>

<section>
 <div id="formulaire_inscription"> 

	<h1>Page d'inscription</h1>

    <form action="submit_contact.php" method="POST">
          <input type="text" id="Name" name="Name" placeholder="Nom"><br>
          <input type="text" id="Surname" name="Surname" placeholder="Prénom"><br>
          <input type="text" id="UserName" name="UserName" placeholder="Nom d'utilisateur"><br>
          <input type="password" id="Password" name="Password" placeholder="Mot de passe"><br>
          <input type="text" id="SecretQuestion" name="SecretQuestion" placeholder="Question secrète"><br>
          <input type="text" id="SecretAnswer" name="SecretAnswer" placeholder="Réponse à la question secrète"><br><br>
          <button type="submit" value="Inscription"><strong>Inscription</strong><br>
    </form>

 </div> 
</section>
  </body>
</html>

<?php include_once('footer.php'); ?>
