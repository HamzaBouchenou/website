<?php
  // Permet de savoir s'il y a une session. 
  // C'est-à-dire si un utilisateur s'est connecté à votre site 
  session_start(); 
  
  // Fichier PHP contenant la connexion à votre BDD
  include('database.php'); 
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
 <title>Accueil</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">

 </head>
 <body>
 <?php
 require_once('menu.php');
 ?>
<div class="container text-center">
  <div class="row">
    <div class="col-sm-0 col-md-2 col-lg-3"></div>
    <div class="col-sm-12 col-md-8 col-lg-6">
    <h1 style="text-align:center">Mon Forum</h1>
    <div>
      <?php
      if(!isset($_SESSION['id'])){ // Si on ne détecte pas de session alors on verra les liens ci-dessous
      ?>
      <?php
      }
      ?>
    </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>