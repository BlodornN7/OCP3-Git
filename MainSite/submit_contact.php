<?php 
try
{
    $db = new PDO('mysql:host=localhost;dbname=gbaf_database;charset=utf8', 'root', 'root');
}

catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());
}


$name = $_POST['Name'];
$surname = $_POST['Surname'];
$username = $_POST['UserName'];
$password = $_POST['Password'];
$secretquestion = $_POST['SecretQuestion'];
$secretanswer = $_POST['SecretAnswer'];
//
$CheckUsernameAvailableSQL = 'SELECT * FROM users WHERE username = $username ';
$CheckFullNameAvailableSQL = 'SELECT * FROM users WHERE username = $fullname ';

//Demande à l'utilisateur si le nom d'utilisateur est déjà utilisé
$CheckUsernameAvailableSQL = $db->prepare("SELECT * FROM users WHERE username = :username");
$CheckUsernameAvailableSQL->bindParam(':username', $username);
$CheckUsernameAvailableSQL->execute();
$user1 = $CheckUsernameAvailableSQL->fetch();

if (empty($name) || empty($surname) || empty($username) || empty($password) || empty($secretquestion) || empty($secretanswer)) {
    echo "Un des champs est vide, merci de bien vouloir vérifier vos informations";
    exit();
}



elseif ($user1) {
    echo "Le nom d'utilisateur n'est pas disponible";
    exit(); // ce code stoppe le script
} 

else {

    

//Ecriture de la requête
$sqlQuery = 'INSERT INTO users(nom, prenom, username, password, question, reponse) VALUES (:nom, :prenom, :username, :password, :question, :reponse)';
//Préparation
$insertUser = $db->prepare($sqlQuery);
// Execution
$insertUser->execute([
'nom' => $name,
'prenom' => $surname,
'username' => $username,
'password' => $password,
'question' => $secretquestion,
'reponse' => $secretanswer,

]);
header('location: login.php');}

?>


    
