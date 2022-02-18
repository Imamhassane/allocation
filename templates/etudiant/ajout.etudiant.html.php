<?php
use App\Core\Session;

$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}
?>
<div class="container wrapper fadeInDown addEtu" >
    <div id="formConten">
    <h2 class="active"> Ajouter un etudiant</h2>
        <form method="post" action="<?=WEBROOT."etudiant/addEtudiant"?>">
        <div class="row">
            <div class="form-group">
                    <input type="text" id="" class="fadeIn second" name="nom" placeholder="nom">
                    <?php if(isset($arrErrors['nom'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['nom']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <input type="text" id="" class="fadeIn third" name="prenom" placeholder="prenom">
                    <?php if(isset($arrErrors['prenom'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['prenom']?></small>
                    <?php endif ?>
            </div>
            
        </div>
        <div class="row">
            <div class="form-group">
                    <input type="text" id="" class="fadeIn second" name="login" placeholder="email">
                    <?php if(isset($arrErrors['login'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['login']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <input type="date" id="" class="fadeIn third" name="dateNaissance" placeholder="dateNaissance">
                    <?php if(isset($arrErrors['prenom'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['dateNaissance']?></small>
                    <?php endif ?>
            </div>
            
        </div>
        <div class="row">
            <div class="form-group">
                    <input type="tel" id="" class="fadeIn second" name="telephone" placeholder="telephone">
                    <?php if(isset($arrErrors['telephone'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['telephone']?></small>
                    <?php endif ?>
            </div>
            <?php if($url[1]=="ajoutEtudiantNB"):?>
                <div class="form-group">
                        <input type="text" id="" class="fadeIn second" name="adresse" placeholder="adresse">
                        <?php if(isset($arrErrors['adresse'])): ?>
                            <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['adresse']?></small>
                        <?php endif ?>
                </div>
            <?php endif ?>
            <?php if($url[1]=="ajoutEtudiantBL" || $url[1]=="ajoutEtudiantBNL"):?>
                <div class="form-group">
                    <select class="select" name="typebourse" id="" >
                        <option value="select">Sélectionner le type de bourse</option>
                        <option value="demi-bourse">Demi-bourse</option>
                        <option value="bourse-entiere">Bourse entière </option>
                    </select>
                    <?php if(isset($arrErrors['typebourse'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['typebourse']?></small>
                    <?php endif ?>
                </div>
            <?php endif ?>
            <?php if($url[1]=="ajoutEtudiantBL"):?>
                    <div class="form-group">
                        <select class="select" name="chambreEtu" id="" >
                            <option value="select">Sélectionner une chambre</option>
                            <option value="test">test</option>
                            <option value="test1">test2 </option>
                        </select>
                        <?php if(isset($arrErrors['chambreEtu'])): ?>
                            <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['chambreEtu']?></small>
                        <?php endif ?>
                    </div>
            <?php endif ?>
        </div>
            <input type="submit" class="fadeIn fourth" value="Ajouter">
        </form>
    </div>
</div>