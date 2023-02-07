


<!DOCTYPE html>
<html>
<head>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php include_once('header.php'); ?>

<main>
	
<div class="h1">

    <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
les axes de la réglementation financière française. Sa mission est de promouvoir
l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
pouvoirs publics.</p>
    <div id="illustrationbox">
    <img id="illustration" src="images/logo.png">
    </div>
    

</div>


<div> 

	<h2>Texte acteurs & partenaires</h2>
	<p>Présentation lorem ipsum dksjfdlfskfhjdsklfhsjfdklshjdskfshdjk</p>

</div>


<section class="h3link">

	<div class="mainborder">
		<?php 
		 foreach ($Acteur as $Acteurs) { ?>
			
		<?php $paragraphe = $Acteurs['description'];
              $longueur = 200;
              $texte_coupe = substr($paragraphe, 0, $longueur); ?> 

		<div class="frame">
		    <img class="image" src="<?=$Acteurs['logo'];?>">
			 <h3> <?=$Acteurs['acteur'];?></h3>
			 <p><?= $texte_coupe . "..."; ?></p>
			 
			 
			 <div class="border">
		     <button class="readmore"><a href="pageacteur.php?id=<?=$Acteurs['id_acteur'];?>">lire la suite</a></button>
		 
		</div>
	</div>
	 	
	  	 
	  


	<?php } ?>
	</section>


</main>
<?php include_once('footer.php'); ?>
</body>
</html> 

