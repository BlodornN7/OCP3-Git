<?php session_start(); 

foreach($Acteur as $Acteurs) {
if ($id == $Acteurs['id_acteur']) { ?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styleacteur.css">
</head>

<body>
	<?php include_once('header.php'); ?>



<section id="sectionacteur1">
	<div class="logoacteurdiv" >
	<h1> <?php echo '<img class="image" src="'.$Acteurs['logo'].'">'; ?></h1>
	</div>




<?php echo $Acteurs['description']; ?>

<form action="Acteur.php" method="post">
 <?php echo ' <input type="hidden" name="id_acteur" value="'.$Acteurs['id_acteur'].'">';?>
  <input type="submit" name="like" value="1">
  <input type="submit" name="dislike" value="-1">
  
 <?php //Prends le nombre de like/dislike et en fait un total puis l'affiche

   echo 'La somme des likes et des dislikes est de '.$result[0]['total'].''; 
    ?>
  
  
</form>

</section>


<section id="commentaire">

	<h3> Commentaires </h3>

	

	

	

	   
	<form method="post">
  <button id="Newcomment" type="submit" name="show-form-button">Nouveau commentaire</button>
  <input type="hidden" name="form-state" value="hidden">
        </form>'
	   
	
	<?php // Si l'utilisateur clique sur le bouton, alors il affiche le champs pour remplir son commentaire et le soumettre 
	    if(isset($_POST['show-form-button']))
	{
           $_POST['form-state'] = 'visible';
     }
        if($_POST['form-state'] === 'visible'){
  echo '<form id="commentform" method="POST">
  <label for="Post">Commentaire</label><br>
  <textarea id="Post" name="Post" rows="5" cols="80"></textarea><br>
  <input type="submit" value="Publier mon commentaire"><br> </form>';
} ?>



        
		

    <?php //include_once("testliaison.php"); //Inclus le code permettant de faire la liaison entre la table user_new et vote
	       foreach ($result as $test) { ?>
		<div class="CommentSection">
	<p> Auteur : <?php echo $test['prenom']; ?> </p>
	<p> Date : <?php echo $test['date_add']; ?> </p>
	<p> Commentaire : <?php echo $test['post']; ?> </p>
	
	</div>
	<?php } ?>


	








</section>

<?php include_once('footer.php'); ?>
<?php }}; ?>






















</body>