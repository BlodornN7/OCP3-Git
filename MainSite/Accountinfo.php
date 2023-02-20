<?php session_start();
if ($_SESSION['logged_in'] !== true) {
  header ('location: login.php');
  exit;
} ?>
<html>
  <head>
    <title>Page d'information du compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
  </head>
  <body>

<?php include_once('header.php'); ?>

</section>
<section id="informations">
<h1> Vos informations </h1>

<form action="ValidateAccountModification.php" method="POST">
<label for="Name">Nom:</label><br>
      <input type="text" id="Name" name="Name" value="<?=$_SESSION["name"];?>"><br>
      <button type="submit" value="Modifier mon nom">Modifier mon nom</button></form>
 
<form action="ValidateAccountModification.php" method="POST">
<label for="Surname">Prénom :</label><br>
      <input type="text" id="Surname" name="Surname" value="<?=$_SESSION["surname"];?>"><br>
      <button type="submit" value="Modifier mon prénom">Modifier mon prénom</button></form>      

<form action="ValidateAccountModification.php" method="POST">
<label for="UserName">Nom d'utilisateur :</label><br>
      <input type="text" id="UserName" name="UserName" value="<?=$_SESSION["username"];?>"><br>
      <button type="submit" value="Modifier mon nom d'utilisateur">Modifier mon nom d'utilisateur</button> </form>
      
<form action="ValidateAccountModification.php" method="POST">      
<label for="Password">Mot de passe :</label><br>
      <input type="password" id="Password" name="Password" value="<?=$_SESSION["password"];?>"><br>
      <button type="submit" value="Modifier mon mot de passe">Modifier mon mot de passe</button> </form>
            
<form action="ValidateAccountModification.php" method="POST">
<label for="SecretQuestion">Question secrète :</label><br>
      <input type="text" id="SecretQuestion" name="SecretQuestion" value="<?=$_SESSION["secret_question"];?>"><br>
      <button type="submit" value="Modifier ma question secrète">Modifier ma question secrète</button> </form>

<form action="ValidateAccountModification.php" method="POST">
<label for="SecretAnswer">Réponse secrète :</label><br>
      <input type="text" id="SecretAnswer" name="SecretAnswer" value="<?=$_SESSION["secret_answer"];?>"><br>
      <button type="submit" value="Modifier ma réponse secrète">Modifier ma réponse secrète</form>

</section>


<?php include_once('footer.php'); ?>
</body>
</html>