<?php
  session_start();
  include('database.php'); // Fichier PHP contenant la connexion à votre BDD
 
 // S'il y a une session alors on ne retourne plus sur cette page
  if (isset($_SESSION['id'])){
    header('Location: index');
    exit;
  }
 
  // Si la variable "$_Post" contient des informations alors on les traitres
  if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    if (isset($_POST['connexion'])){
      $email = htmlentities(strtolower(trim($email)));
      $password = trim($password);
 
      if(empty($email)){ // Vérification qu'il y est bien un mail de renseigné
        $valid = false;
        $er_email = "Il faut mettre un mail";
      }
 
      if(empty($password)){ // Vérification qu'il y est bien un mot de passe de renseigné
        $valid = false;
        $er_password = "Il faut mettre un mot de passe";
      }

      if ($valid){

        $req = $DB->query("SELECT * FROM user WHERE email = ?", [$email]);
        $req = $req->fetch();
        if ($req && password_verify($password, $req['password'])) {

          $_SESSION['id'] = $req['id']; // id de l'utilisateur unique pour les requêtes futures
          $_SESSION['username'] = $req['username'];
          $_SESSION['email'] = $req['email'];
  
          header('Location: index');
          exit;
        }else{
          $er_email = "Le mail ou le mot de passe est incorrect";
        }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="style.css" rel="stylesheet">

 </head>
 <body>
   <?php
   require_once('menu.php');
   ?>
<div class="container text-center">
  <div class="row">
    <div class="col-sm-0 col-md-2 col-lg-3"></div>
    <div class="col-sm-12 col-md-8 col-lg-6">   
      <div class="cdr-ins">
        <h1>Se connecter</h1>
        <form method="post">
            <?php
                if (isset($er_email)){
            ?>
                <div class="er-msg"><?= $er_email ?></div>
            <?php   
                }
            ?>
             <div class="form-group mb-3 text-start">
                <label for="email1" class="form-label">Email</label>
                <input class="form-control" type="email" id="email1" placeholder="Adresse mail" name="email" value="<?php if(isset($email)){ echo $email; }?>">
             </div>
            <?php
                if (isset($er_password)){
            ?>
                <div class="er-msg"><?= $er_password ?></div>
            <?php   
                }
            ?>
             <div class="form-group mb-3 text-start">
                <label for="password1" class="form-label">Mot de passe</label>
                <input class="form-control" type="password" id="password1" placeholder="Mot de passe" name="password" value="<?php if(isset($password)){ echo $password; }?>">
              </div>
            <div class="form-group mb-3 text-start"><button type="submit" class="btn btn-primary" name="connexion">Se connecter</button></div>
          </form>
      </div>
    </div>
  </div>
</div>
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>