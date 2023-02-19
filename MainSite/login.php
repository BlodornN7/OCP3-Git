<!DOCTYPE html>

<html>
  <head>
    <title>Page de connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/connexion.css">
  </head>
  <body>

<?php include_once('header.php');
 
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
$password = $_POST['password'];


$CheckUsernameAndPassWordSQL = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
$CheckUsernameAndPassWordSQL->bindParam(':username', $username);
$CheckUsernameAndPassWordSQL->bindParam(':password', $password);
$CheckUsernameAndPassWordSQL->execute();
$user3 = $CheckUsernameAndPassWordSQL->fetch();

if ($user3["username"] === $username && $user3["password"] === $password) {
    
    session_start ();
    $_SESSION['name'] = $user3['nom'];
    $_SESSION['surname'] = $user3['prenom'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['secret_question'] = $user3['question'];
    $_SESSION['secret_answer'] = $user3['reponse'];
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user3['id_user'];
    header ('location: index.php');
        
}
else {echo '

            <section id="incorrect">

            <div class="formulaire">

                Identifiants incorrects
                <br> 
                <a href="login.php">Revenir à la page de connexion</a>
            </div>

            </section>


';}}


else { echo ' 

<section> 
    <form class="formulaire" method="POST">
          <h1>Connectez-vous</h1>
          
          <input type="text" id="username" name="username" placeholder="Nom d\'utilisateur"><br>
          <input type="password" id="password" name="password" placeholder="Mot de passe"><br><br>
          <button type="submit" value="Se connecter"> <strong> connexion </strong> </button><br>
          <p>Pas encore inscrit ? <a href="Pageinscription.php">Créez votre compte</a> </br> Mot de passe oublié ? <a href="Passwordreset.php">Cliquez ici</a> </p>

    </form> 
</section>';
 } ?> 
</body>
<?php include_once('footer.php'); ?>        


        