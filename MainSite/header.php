<?php 
if (session_status() == PHP_SESSION_ACTIVE) { 
?>
<header> 
  <nav id="navbox">
   <p> <a href="disconnect.php"> Se déconnecter </a> </p>
    <p><a href="Accountinfo.php"><?=$_SESSION['surname'];?> <?=$_SESSION['name'];?></a></p>
  </nav>	
  <div id="image">
    <a href="index.php"><img src="images/logo.png" alt="Logo de l\'entreprise"></a>
  </div> 
</header>
<?php
} else { 
?> 

<header>

 <nav id="navbox">
    <p> <a href="login.php">Se connecter</a> | <a href="Pageinscription.php">S'inscrire</a> </p>
 </nav>

<!--<div id="connecter">
      <p>
        <a href="login.php">Se connecter</a>   |   <a href="Pageinscription.php">S'inscrire</a>
      </p>
</div>--> 
 

  <div id="image">
    <a href="index.php"><img src="images/logo.png" alt="Logo de l\'entreprise"></a>
  </div> 
 
</header>
<?php 
}; 
?>