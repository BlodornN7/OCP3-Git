<?php session_start();

$id = $_GET['id'];
try
{
    $db = new PDO('mysql:host=localhost;dbname=gbaf_database;charset=utf8', 'root', 'root');
}

catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());
}





 if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['like']))  {



$acteurid = $_POST['id_acteur'];
$like = $_POST['like'];
$userid = $_SESSION['user_id'];
//Selectionne l'éventuelle entrée du like si il existe
$checklike = $db->prepare('SELECT item_id FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
$checklike->bindParam(':id_user', $_SESSION['user_id']);
$checklike->bindParam(':id_acteur', $acteurid);
$checklike->execute();

// Si le total des valeurs est supérieur à 0, alors supprime le like qui équivaut à 1
if ($checklike->rowCount() > 0) {
$SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
$SQLQueryDeleteLike->bindParam(':id_user', $userid);
$SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
$SQLQueryDeleteLike->execute(); } 
//Sinon ajoute un like ayant comme valeur 1 dans la table ainsi que les id acteurs et utilisateur
else {

$SQLQueryLike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
$SQLQueryLike->bindParam(':id_user', $userid);
$SQLQueryLike->bindParam(':id_acteur', $acteurid);
$SQLQueryLike->bindParam(':vote', $like);
$SQLQueryLike->execute();
} }
// Sinon si une requète de type POST contenant le terme 'dislike' est reçue alors ...
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['dislike'])) {
$acteurid = $_POST['id_acteur'];
$dislike = $_POST['dislike'];
$userid = $_SESSION['user_id'];

// Selectionne l'éventuelle entrée du dislike si il existe
$checkdislike = $db->prepare('SELECT item_id FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
$checkdislike->bindParam(':id_user', $_SESSION['user_id']);
$checkdislike->bindParam(':id_acteur', $acteurid);
$checkdislike->execute();
//Si il ne trouve pas de dislike de l'utilisateur alors ajoute en un
if ($checkdislike->rowCount() == 0) {
	$SQLQueryDislike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
$SQLQueryDislike->bindParam(':id_user', $userid);
$SQLQueryDislike->bindParam(':id_acteur', $acteurid);
$SQLQueryDislike->bindParam(':vote', $dislike);
$SQLQueryDislike->execute();
}
// Sinon supprime le dislike déjà présent
else {



$SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$SQLQueryDeleteLike->bindParam(':id_user', $userid);
	$SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
	$SQLQueryDeleteLike->execute(); } 
} 

$idacteur = $Acteurs['id_acteur'];
$getlikesum = $db->prepare('SELECT SUM(vote) AS total FROM vote WHERE id_acteur = :id_acteur');
$getlikesum->bindParam(':id_acteur', $idacteur);
$getlikesum->execute();
$result = $getlikesum->FetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Post']))  {
		 
	
    $post = $_POST["Post"];
    $user_id = $_SESSION["user_id"];
    $acteur_id = $Acteurs['id_acteur'];
    $date = date("d/m/Y");
    
    $SqlQuery = 'INSERT INTO post(post, id_user, id_acteur, date_add) VALUES (:post, :id_user, :id_acteur, :date_add)';
    $SetComment = $db->prepare($SqlQuery);
    $SetComment->execute([
    'post' => $post,
    'id_user' => $user_id,
    'id_acteur' => $acteur_id,
    'date_add' => $date,
    ]); }
    
    $SqlQuery1 = 'SELECT prenom, post.post, post.date_add FROM users_new INNER JOIN post ON users_new.id_user=post.id_user WHERE id_acteur = :id_acteur';
    $testliaisontable = $db->prepare($SqlQuery1);
    $testliaisontable->bindParam(':id_acteur', $Acteurs['id_acteur']);
    $testliaisontable->execute();
    $result = $testliaisontable->FetchAll();

$SqlQuery ='SELECT * FROM acteur';
$ShowActeurs = $db->prepare($SqlQuery);
$ShowActeurs->execute();
$Acteur = $ShowActeurs->FetchAll();

?>
    
