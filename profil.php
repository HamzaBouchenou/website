<?php
  session_start(); 
  include('database.php'); 
  // S'il n'y a pas de session alors on ne va pas sur cette page
  if(!isset($_SESSION['id'])){ 
    header('Location: index'); 
    exit; 
  }
  // On récupère les informations de l'utilisateur connecté
  $afficher_profil = $DB->query("SELECT * 
    FROM user
    WHERE id = ?", 
  array($_SESSION['id']));
  
  $afficher_profil = $afficher_profil->fetch(); 
?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon profil</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

  <head>
  <body>
   <?php
   require_once('menu.php');
   ?>
    <div class="container text-center">
    <div class="row">
    <div class="col-sm-0 col-md-2 col-lg-3"></div>
    <div class="col-sm-12 col-md-8 col-lg-6"> 
    <div class="cdr-ins">
    <h2>Voici le profil de <?= $afficher_profil['username']; ?></h2>
   <div style="text-align: left;">Quelques informations sur vous : </div>
    <ul style="text-align: left;">
      <li>Votre id est : <?= $afficher_profil['id'] ?></li>
      <li>Votre mail est : <?= $afficher_profil['email'] ?></li>
    </ul>
    </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>