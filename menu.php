 <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Accueil</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
    if(!isset($_SESSION['id'])){ // Si on ne détecte pas de session alors on verra les liens ci-dessous
     ?>
   <?php
   }else{ // Sinon s'il y a une session alors on verra les liens ci-dessous
  ?>
   <li class="nav-item">
          <a class="nav-link" href="categorie">Forum</a>
    </li>
    <li class="nav-item">
          <a class="nav-link" href="profil">Mon profil</a>
    </li>
   <?php
}
 ?>
      </ul>
      <ul class="navbar-nav ml-md-auto mb-2 mb-lg-0">
         <?php
    if(!isset($_SESSION['id'])){ // Si on ne détecte pas de session alors on verra les liens ci-dessous
     ?>
       <li class="nav-item">
          <a class="nav-link" href="inscription">Inscription</a>
       </li>
         <li class="nav-item">
          <a class="nav-link" href="connexion">Connexion</a>
       </li>
      <!-- Liens de nos futures pages -->
   
   <?php
   }else{ // Sinon s'il y a une session alors on verra les liens ci-dessous
  ?>
  <li class="nav-item">
          <a class="nav-link" href="deconnexion">Déconnexion</a>
  </li>
   <?php
}
 ?>
      </ul>
    </div>
  </div>
</nav>