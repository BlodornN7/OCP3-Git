<?php 
if (session_status() == PHP_SESSION_ACTIVE) { 
?>
<header> 
  <nav id="navbox">
    <p><a href="Accountinfo.php"><?=$_SESSION['surname'];?> <?=$_SESSION['name'];?></a></p>
    <p> <a href="disconnect.php"> Se déconnecter </a> </p>
  </nav>	
  <a id="mainlogo" href="index.php"><img src="images/logo.png" alt="Logo de l\'entreprise"></a>
</header>
<?php
} else { 
?> 
<header>
  <nav id="navbox">
    <p> <a href="login.php"> Se connecter </a> </p>
    <p> <a href="Pageinscription.php"> S'inscrire </a> </p>
  </nav>	
  <a id="mainlogo" href="login.php"><img src="images/logo.png" alt="Logo de l\'entreprise"></a>
</header>
<?php 
}; 
?>