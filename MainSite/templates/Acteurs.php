<?php //Beginning of SQL Queries
      error_reporting(0); //ignore les erreurs non pertinentes





 // Si une requète de type POST contenant le terme 'like' est reçue alors ...	
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['like']))  {



$acteurid = $_POST['id_acteur'];
$like = $_POST['like'];
$userid = $_SESSION['user_id'];
//Selectionne l'éventuelle entrée du like si il existe
$checklike = $db->prepare('SELECT item_id FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
$checklike->bindParam(':id_user', $_SESSION['user_id']);
$checklike->bindParam(':id_acteur', $acteurid);
$checklike->execute();


// Si le total des valeurs est égal à 1, alors supprime le like qui équivaut à 1
if ($checklike->rowCount() == 1) {
$SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
$SQLQueryDeleteLike->bindParam(':id_user', $userid);
$SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
$SQLQueryDeleteLike->execute(); } 


//Sinon ajoute un like/1 
else {
	$SQLQueryLike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
$SQLQueryLike->bindParam(':id_user', $userid);
$SQLQueryLike->bindParam(':id_acteur', $acteurid);
$SQLQueryLike->bindParam(':vote', $like);
$SQLQueryLike->execute();
}
}
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
// Sinon supprime le dislike OU le like déjà présent
else {



$SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$SQLQueryDeleteLike->bindParam(':id_user', $userid);
	$SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
	$SQLQueryDeleteLike->execute(); } 
}
// Fait la liaison entre la table user et vote et en fait un tableau
$SqlQuery1 = 'SELECT prenom, post.post, post.date_add FROM users_new INNER JOIN post ON users_new.id_user=post.id_user WHERE id_acteur = :id_acteur ORDER BY date_add DESC' ;
	    $testliaisontable = $db->prepare($SqlQuery1);
	    $testliaisontable->bindParam(':id_acteur', $Acteurs['id_acteur']);
	    $testliaisontable->execute();
	    $result = $testliaisontable->FetchAll();

		$idacteur = $Acteurs['id_acteur'];
		$getlikesum = $db->prepare('SELECT COUNT(vote) AS total_rows FROM vote WHERE id_acteur = :id_acteur AND vote = 1');
		$getlikesum->bindParam(':id_acteur', $idacteur);
		$getlikesum->execute();
		$resultlike = $getlikesum->FetchAll();
	   
		
		$getdislikesum = $db->prepare('SELECT COUNT(vote) AS total_rows FROM vote WHERE id_acteur = :id_acteur AND vote = -1');
		$getdislikesum->bindParam(':id_acteur', $idacteur);
		$getdislikesum->execute();
		$resultdislike = $getdislikesum->FetchAll();


// End of SQL Queries 
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styleacteur.css">
</head>

<body>
	<?php include_once('header.php'); ?>



<section id="sectionacteur1">
	<div class="logoacteurdiv" >
	<h1><img class="image" src="<?=$Acteurs['logo'];?>"></h1>
	</div>
<?= $Acteurs['description']; ?>

<form method="post">
 <input type="hidden" name="id_acteur" value="<?=$Acteurs['id_acteur'];?>"><br><br>
 <input type="submit" name="like" value="1">
 <input type="submit" name="dislike" value="-1">

 <script>
 document.getElementById("like-button").value = "Like";
 document.getElementById("dislike-button").value = "Dislike";
</script>
  
 <?php //Prends le nombre de like/dislike et en fait un total puis l'affiche
       if($resultlike[0]['total_rows'] == 0 && $resultdislike[0]['total_rows'] == 0) {
		echo "Il n'y aucun like ou dislike sur cet acteur";
	   }
	   else {
       echo '<p>like ='.$resultlike[0]['total_rows'].'</p>'; 
	   echo '<p>Dislike ='.$resultdislike[0]['total_rows'].'</p>'; 
	   }
    ?>
  
  
</form>

</section>


<section id="commentaire">

	<h3> Commentaires </h3>

	

	

	<?php // Si php détecte la publication de la publication, il remerci l'utilisateur et confirme le post
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
		]);
		Echo 'Merci, '.$_SESSION["surname"].'. Votre commentaire a bien été ajouté.';
		header("Refresh:2");
			
	}

	   else // Si le formulaire n'as pas encore été posté, il montre à l'utilisateur le bouton "Nouveau commentaire"
	    { ?>
		<form method="post">
        <button id="Newcomment" type="submit" name="show-form-button">Nouveau commentaire</button>
        <input type="hidden" name="form-state" value="hidden">
        </form>
	   <?php } ?>
	
	<?php // Si l'utilisateur clique sur le bouton, alors il affiche le champs pour remplir son commentaire et le soumettre 
	    if(isset($_POST['show-form-button']))
	{
           $_POST['form-state'] = 'visible';
     }
        if($_POST['form-state'] === 'visible'){ ?>
  <form id="commentform" method="POST">
  <label for="Post">Commentaire</label><br>
  <textarea id="Post" name="Post" rows="5" cols="80"></textarea><br>
  <input type="submit" value="Publier mon commentaire"><br> </form>
<?php } ?>



        
		

    <?php 
	    
	    foreach ($result as $test) { ?>
		<div class="CommentSection">
	<p> Auteur : <?= $test['prenom']; ?> </p>
	<p> Date : <?= $test['date_add']; ?> </p>
	<p> Commentaire : <?= $test['post']; ?> </p>
	
	</div>
	<?php } ?>


	








</section>

<?php include_once('footer.php'); ?>

</body>