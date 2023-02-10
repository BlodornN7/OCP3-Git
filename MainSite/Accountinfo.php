<?php session_start();
if ($_SESSION['logged_in'] !== true) {
  header ('location: login.php');
  exit;
} ?>
<html>
  <head>
    <title>Page d'information du compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

<?php include_once('header.php'); ?>

</section>
<section id="AccountModification">
<h1> Vos informations </h1>

<form action="ValidateAccountModification.php" method="POST">
<label for="Name">Nom:<label><br>
      <input type="text" id="Name" name="Name" value="<?=$_SESSION["name"];?>"><br><br>
      <input type="submit" value="Modifier mon nom"><br> </form>
 
<form action="ValidateAccountModification.php" method="POST">
<label for="Surname">Prénom :</label><br>
      <input type="text" id="Surname" name="Surname" value="<?=$_SESSION["surname"];?>"><br><br>
      <input type="submit" value="Modifier mon prénom"><br> </form>      

<form action="ValidateAccountModification.php" method="POST">
<label for="UserName">Nom d'utilisateur :</label><br>
      <input type="text" id="UserName" name="UserName" value="<?=$_SESSION["username"];?>"><br><br>
      <input type="submit" value="Modifier mon nom d'utilisateur"><br> </form>
      
<form action="ValidateAccountModification.php" method="POST">      
<label for="Password">Mot de passe :</label><br>
      <input type="password" id="Password" name="Password" value="<?=$_SESSION["password"];?>"><br><br>
      <input type="submit" value="Modifier mon mot de passe"><br><br> </form>
            
<form action="ValidateAccountModification.php" method="POST">
<label for="SecretQuestion">Question secrète :</label><br>
      <input type="text" id="SecretQuestion" name="SecretQuestion" value="<?=$_SESSION["secret_question"];?>"><br><br>
      <input type="submit" value="Modifier ma question secrète"><br><br> </form>

<form action="ValidateAccountModification.php" method="POST">
<label for="SecretAnswer">Réponse secrète :</label><br>
      <input type="text" id="SecretAnswer" name="SecretAnswer" value="<?=$_SESSION["secret_answer"];?>"><br><br>
      <input type="submit" value="Modifier ma réponse secrète"><br> </form>

</section>


<?php include_once('footer.php'); ?>
</body>
</html>