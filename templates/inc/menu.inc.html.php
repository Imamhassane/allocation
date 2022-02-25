  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="nav-links">
        <ul class="links">
          <li><a class="active" href="<?=WEBROOT.'chambre/listeChambre/page=1'?>">LISTE DES CHAMBRES</a></li>
          <li><a href="<?=WEBROOT.'pavillon/listePavillon/page=1'?>">LISTE DES PAVILLONS</a></li>
          <li><a class="active" href="<?=WEBROOT.'etudiant/listeEtudiant/page=1'?>">LISTE DES ETUDIANTS</a></li> 
          <li><a class="active" href=" <?=WEBROOT.'etudiant/ajoutEtudiant'?>">AJOUTER UN ETUDIANT</a></li> 

         
        </ul>
      </div>
      <div class="search-box">
        <i class='bx-search '> Log out <span class="iconify" data-icon="bx:power-off"></span></i>
        <div class="input-box">
          <a name="" id="" class="btn float-righ " href="<?= WEBROOT . 'security/logout' ?>" role="button">Deconnexion</a>
        </div>
      </div>
    </div>
</nav>

<script src="<?=WEBROOT.'/js/app.js'?>"></script>