<?php
  session_start();
  include('database.php'); // Fichier PHP contenant la connexion à votre BDD
 
  // S'il y a une session alors on ne retourne plus sur cette page
  if (isset($_SESSION['id'])){
    header('Location: /index.php');
    exit;
  }
 
  // Si la variable "$_Post" contient des informations alors on les traitres
  if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    // On se place sur le bon formulaire grâce au "name" de la balise "input"
    if (isset($_POST['inscription'])){
      $username = htmlentities(trim($username)); 
      $email = htmlentities(strtolower(trim($email))); // On récupère le mail
      $password = trim($password); 
 
      // Vérification du nom
      if(empty($username)){
        $valid = false;
        $er_username = ("username ne peut pas être vide");
      }else{
            $req_username = $DB->query("SELECT username FROM user WHERE username = ?", array($username));
            $req_username = $req_username->fetch();

           if ($req_username && $req_username['username'] <> "") {
             $valid = false;
             $er_username = "Ce nom d'utilisateur est déjà utilisé";
            }
      }   

 
      // Vérification du mail
      if(empty($email)){
        $valid = false;
        $er_email = "Le mail ne peut pas être vide";
 
        // On vérifit que le mail est dans le bon format
      }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
        $valid = false;
        $er_email = "Le mail n'est pas valide";
 
      }else{
        // On vérifit que le mail est disponible
        $req_email = $DB->query("SELECT email FROM user WHERE email = ?",
          array($email));
 
        $req_email = $req_email->fetch();
 
        if ($req_email['email'] <> ""){
          $valid = false;
          $er_email = "Ce mail existe déjà";
        }
      }
 
      // Vérification du mot de passe
      if(empty($password)) {
        $valid = false;
        $er_password = "Le mot de passe ne peut pas être vide";
      }
      // Si toutes les conditions sont remplies alors on fait le traitement
      if($valid){
 
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        // On insert nos données dans la table utilisateur
        $DB->insert("INSERT INTO user (username, email, password) VALUES
          (?, ?, ?)",
          array($username, $email, $hashpassword));
 
        header('Location: index.php');
        exit;
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
    <title>Inscription</title>
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
       <h1>Inscription</h1>
       <form method="post">
        <?php
                // S'il y a une erreur sur le nom alors on affiche
            if (isset($er_username)){
            ?>
                <div class="er-msg"><?= $er_username ?></div>
            <?php   
                }
            ?>
            <div class="form-group mb-3 text-start">
            <input class="form-control" type="text" placeholder="Username" name="username" value="<?php if(isset($username)){ echo $username; }?>">      
            </div>
            <?php
                if (isset($er_email)){
                ?>
                    <div class="er-msg"><?= $er_email ?></div>
                <?php   
                }
            ?>
            <div class="form-group mb-3 text-start">
            <input class="form-control" type="email" placeholder=" Adresse mail" name="email" value="<?php if(isset($email)){ echo $email; }?>">
            </div>
            <?php
                if (isset($er_password)){
                ?>
                    <div class="er-msg"><?= $er_password ?></div>
                <?php   
                }
            ?>
            <div class="form-group mb-3 text-start">
            <input class="form-control" type="password" placeholder="Mot de passe" name="password" value="<?php if(isset($password)){ echo $password; }?>">
            </div>
            <div class="form-group mb-3 text-start"><button type="submit" class="btn btn-primary" name="inscription">Envoyer</button></div>
        </form>
      </div>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>