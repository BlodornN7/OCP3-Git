<?php //Beginning of SQL Queries
      error_reporting(0); //ignore les erreurs non pertinentes





 // Si une requête de type POST contenant le terme 'like' est reçue alors ...	
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $acteurid = $_POST['id_acteur'];
    $like = $_POST['like'];
    $userid = $_SESSION['user_id'];
    //Selectionne l'éventuelle entrée du like si elle existe
    $checklike = $db->prepare('SELECT vote FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
    $checklike->bindParam(':id_user', $_SESSION['user_id']);
    $checklike->bindParam(':id_acteur', $acteurid);
    $checklike->execute();
    $row = $checklike->fetch();

    // Si dans le tableau il y a une entrée "1" alors supprime le like qui est = à 1
    
    if ($row['vote'] == 'J\'aime') {
        $SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
        $SQLQueryDeleteLike->bindParam(':id_user', $userid);
        $SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
        $SQLQueryDeleteLike->execute();
    } 
	//Sinon si dans le tableau il y a une entrée "-1" alors supprime le diskile qui est = à -1 et ajoute un like qui est = à 1

	elseif ($row['vote'] == 'Je n\'aime pas') {
		$SQLQueryDeleteLike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
        $SQLQueryDeleteLike->bindParam(':id_user', $userid);
        $SQLQueryDeleteLike->bindParam(':id_acteur', $acteurid);
        $SQLQueryDeleteLike->execute();

		$SQLQueryLike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
        $SQLQueryLike->bindParam(':id_user', $userid);
        $SQLQueryLike->bindParam(':id_acteur', $acteurid);
        $SQLQueryLike->bindParam(':vote', $like);
        $SQLQueryLike->execute();



	}
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
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset(($_POST['dislike']))) {
$acteurid = $_POST['id_acteur'];
$dislike = $_POST['dislike'];
$userid = $_SESSION['user_id'];

//Selectionne l'éventuelle entrée du dislike si elle existe
$checkdislike = $db->prepare('SELECT vote FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
$checkdislike->bindParam(':id_user', $_SESSION['user_id']);
$checkdislike->bindParam(':id_acteur', $acteurid);
$checkdislike->execute();
$row = $checkdislike->fetch();

//Si dans le tableau il y a une entrée "-1" alors supprime le dislike qui est = à -1
if ($row['vote'] == 'Je n\'aime pas') {
	$SQLQueryDeleteDislike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$SQLQueryDeleteDislike->bindParam(':id_user', $userid);
	$SQLQueryDeleteDislike->bindParam(':id_acteur', $acteurid);
	$SQLQueryDeleteDislike->execute();
}

//Sinon si dans le tableau il y a une entrée "1" alors supprime le like qui est = à 1 et ajoute un dislike qui est = à -1
elseif ($row['vote'] == 'J\'aime') {
	$SQLQueryDeleteDislike = $db->prepare('DELETE FROM vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$SQLQueryDeleteDislike->bindParam(':id_user', $userid);
	$SQLQueryDeleteDislike->bindParam(':id_acteur', $acteurid);
	$SQLQueryDeleteDislike->execute();

$SQLQueryDislike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
$SQLQueryDislike->bindParam(':id_user', $userid);
$SQLQueryDislike->bindParam(':id_acteur', $acteurid);
$SQLQueryDislike->bindParam(':vote', $dislike);
$SQLQueryDislike->execute();
}
// Sinon ajoute un dislike/-1
else {



$SQLQueryDislike = $db->prepare('INSERT INTO vote SET id_user = :id_user, id_acteur = :id_acteur, vote = :vote');
$SQLQueryDislike->bindParam(':id_user', $userid);
$SQLQueryDislike->bindParam(':id_acteur', $acteurid);
$SQLQueryDislike->bindParam(':vote', $dislike);
$SQLQueryDislike->execute();
} 
}
// Fait la liaison entre la table user et vote et en fait un tableau
$SqlQuery1 = 'SELECT prenom, post.post, post.date_add FROM users INNER JOIN post ON users.id_user=post.id_user WHERE id_acteur = :id_acteur ORDER BY date_add DESC' ;
	    $testliaisontable = $db->prepare($SqlQuery1);
	    $testliaisontable->bindParam(':id_acteur', $Acteurs['id_acteur']);
	    $testliaisontable->execute();
	    $result = $testliaisontable->FetchAll();

		$idacteur = $Acteurs['id_acteur'];
		$getlikesum = $db->prepare('SELECT COUNT(vote) AS total_rows FROM vote WHERE id_acteur = :id_acteur AND vote = "j\'aime"');
		$getlikesum->bindParam(':id_acteur', $idacteur);
		$getlikesum->execute();
		$resultlike = $getlikesum->FetchAll();
	   
		
		$getdislikesum = $db->prepare('SELECT COUNT(vote) AS total_rows FROM vote WHERE id_acteur = :id_acteur AND vote = "je n\'aime pas"');
		$getdislikesum->bindParam(':id_acteur', $idacteur);
		$getdislikesum->execute();
		$resultdislike = $getdislikesum->FetchAll();


// End of SQL Queries 
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="CSS/styleacteur.css" >
	<title>Page Acteur de <?=$Acteurs['acteur'];?></title>
</head>

<body>
	<?php include_once('header.php'); ?>



<section id="sectionacteur1">

	<div class="logoacteurdiv" >
	<img class="image" src="<?=$Acteurs['logo'];?>" alt="Logo de <?=$Acteurs['Acteur'];?>">
	</div> <br>
	<h1>Présentation de l'acteur </h1>
	<hr> <br>
	<?= $Acteurs['description']; ?> 
	<br><br>
	Pour en savoir plus, <b><a href="#">rendez-vous sur le site de <?=$Acteurs['acteur'];?> ></a></b>

</section>


<section id="commentaire">

	

	
	<div id="CommentLikeDisplay">
		<div id="CommentDisplay">
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
		Echo '<b>Merci, '.$_SESSION["surname"].'. Votre commentaire a bien été ajouté.</b>';
		header("Refresh:2");
			
	}

	   else // Si le formulaire n'as pas encore été posté, il montre à l'utilisateur le bouton "Nouveau commentaire"
	    { ?>
		<form method="post">
        <button id="Newcomment" type="submit" name="show-form-button">Nouveau commentaire</button>
        <input type="hidden" name="form-state" value="hidden">
        </form>
	   <?php } ?>
		</div>
	   <?php //Prends le nombre de like/dislike et en fait un total puis l'affiche
		if($resultlike[0]['total_rows'] == 0 && $resultdislike[0]['total_rows'] == 0) { ?>
		  <p id="LikeNonePrompt"> <i>Il n'y aucun like ou dislike sur cet acteur pour le moment. </i></p>
		<?php }
		 else {
		echo '<p id="LikeDislikePrompt">'.$resultlike[0]['total_rows'].' personnes ont recommandé cet acteur et '.$resultdislike[0]['total_rows'].' personnes ne le recommande pas</p>'; 
		} ?>

<form id="LikeDislikePost" method="post">
 <input type="hidden" name="id_acteur" value="<?=$Acteurs['id_acteur'];?>">
 <input type="submit" name="like" value="J'aime">
 <input type="submit" name="dislike" value="Je n'aime pas">
</form>

<h1> Commentaires </h1>

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
		</div>


        


    <?php 
	    
	 

	    foreach ($result as $test) { ?>
		<div class="CommentSection">
	<p> <b style="color : #FF0000;"> Auteur : <?= $test['prenom']; ?> </b> <br>
	 <?= $test['date_add']; ?> </p>
	<p> <i> <?= $test['post']; ?> </i></p>
	
	</div>
	<?php } ?>

	</section>
	










<?php include_once('footer.php'); ?>

</body>