  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="nav-links">
        <ul class="links">
          <li><a class="active" href="<?=WEBROOT.'chambre/listeChambre'?>">LISTE DES CHAMBRES</a></li>
          <li><a href="<?=WEBROOT.'pavillon/listePavillon'?>">LISTE DES PAVILLONS</a></li>
          <li><a class="active" href="<?=WEBROOT.'etudiant/listeEtudiant'?>">LISTE DES ETUDIANTS</a></li> 
          <li>
            <a href="#">AJOUTER UN ÉTUDIANT</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="<?=WEBROOT.'etudiant/ajoutEtudiantNB'?>">NON BOURSIER</a></li>
              <li class="more">
                <span><a href="#">BOURSIER</a>
                  <i class='bx bxs-chevron-right arrow more-arrow'></i>
                </span>
                <ul class="more-sub-menu sub-menu">
                  <li><a href="<?=WEBROOT.'etudiant/ajoutEtudiantBL'?>">LOGÉ</a></li>
                  <li><a href="<?=WEBROOT.'etudiant/ajoutEtudiantBNL'?>">NON LOGÉ</a></li>
                </ul>
              </li>
            </ul>
          </li>
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