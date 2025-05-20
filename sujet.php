<?php
  session_start();
  include('database.php'); // Fichier PHP contenant la connexion à votre BDD
  $get_id = (int) trim(htmlentities($_GET['id'])); // On récupère l'id de la catégorie
  $get_sujet = isset($_GET['sujet']) ? (int) trim(htmlentities($_GET['sujet'])) : 0;
  
  if(empty($get_id)){ // On vérifie qu'on a bien un id sinon on redirige vers la page forum
    header('Location: categorie');
    exit;
  }

  if($get_sujet > 0) {
    // Display individual subject
    $req = $DB->query("SELECT S.*, DATE_FORMAT(S.date_creation, 'Le %d/%m/%Y à %H\h%i') as date_c, U.username
      FROM sujet S
      LEFT JOIN user U ON U.id = S.id_user
      WHERE S.id = ? AND S.id_cat = ?", 
      array($get_sujet, $get_id));
    
    $sujet = $req->fetch();
    
    if(!$sujet) {
      header('Location: categorie/' . $get_id);
      exit;
    }
  } else {
    // Display category listing
    $req = $DB->query("SELECT S.*, DATE_FORMAT(S.date_creation, 'Le %d/%m/%Y à %H\h%i') as date_c, U.username
      FROM sujet S
      LEFT JOIN user U ON U.id = S.id_user
      WHERE S.id_cat = ?
      ORDER BY S.date_creation DESC", 
      array($get_id));
    
    $req = $req->fetchAll();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="/website/"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title><?= isset($sujet) ? htmlspecialchars($sujet['titre']) : 'Sujets' ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
  <?php
    require_once('menu.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-0 col-md-0 col-lg-0"></div>
      <div class="col-sm-12 col-md-12 col-lg-12">
        <h1 style="text-align: center">Forum</h1>
        <?php if(isset($sujet)): ?>
          <!-- Display individual subject -->
          <div class="card mb-4">
            <div class="card-header">
              <h2><?= htmlspecialchars($sujet['titre']) ?></h2>
              <div style="text-align: right;">
              <small>Posté par <?= htmlspecialchars($sujet['username']) ?> le <?= $sujet['date_c'] ?></small>
              </div>
            </div>
            <div class="card-body">
              <?= nl2br(htmlspecialchars($sujet['contenu'])) ?>
            </div>
          </div>
          <a href="categorie/<?= $get_id ?>" class="btn btn-primary">Retour aux sujets</a>
        <?php else: ?>
          <!-- Display category listing -->
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Par</th>
              </tr>
              <?php foreach($req as $r): ?>
                <tr>
                  <td><?= $r['id'] ?></td>
                  <td><a href="categorie/<?= $get_id ?>/<?= $r['id'] ?>"><?= htmlspecialchars($r['titre']) ?></a></td>
                  <td><?= $r['date_c'] ?></td>
                  <td><?= htmlspecialchars($r['username']) ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>