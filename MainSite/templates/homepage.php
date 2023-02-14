


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

    <h1 id="presentation_text">Le GBAF (Groupement Banque Assurance Français) est une fédération qui représente les six plus grandes banques et assurances françaises :
		 BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel-CIC, Société Générale, et La Banque Postale. 
		 Le GBAF a pour mission de promouvoir l'industrie bancaire et d'assurance en France et de jouer un rôle de représentant de la profession 
		 auprès des autorités publiques en matière de réglementation financière. Le GBAF gère près de 80 millions de comptes dans le pays.</h1>
    <div id="illustrationbox">
    <img id="illustration" src="images/illustration_bank.jpg">
    </div>
    

</div>


<div> 

	<h2>Vous trouverez ci-dessous la liste des acteurs partenaires du GBAF</h2>

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
			
			 <h3> <?=$Acteurs['acteur'];?></h3><br></br>
			 <p style="font-size: 17px"><?= $texte_coupe . "..."; ?></p>
			 
			 
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

