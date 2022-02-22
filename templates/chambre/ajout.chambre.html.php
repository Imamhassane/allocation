<?php
use App\Core\Session;
$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}

//var_dump($test[0]->idpavillon);

?>
<div class="container wrapper fadeInDown" >
    <div id="formConten">
    <h2 class="active"> Ajouter une chambre</h2>
        <form method="post" action="<?=WEBROOT."chambre/ajoutChambre"?>">
            <input type="hidden" name="id"      value="<?=isset($restor[0]->idchambre)?$restor[0]->idchambre:'' ?>">        

            <div class="form-group">
                    <input type="text" id="" class="fadeIn second" name="numChambre" placeholder="numChambre" value="<?=isset($restor[0]->idchambre)?$restor[0]->numchambre:'' ?>">
                    <?php if(isset($arrErrors['numChambre'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['numChambre']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <input type="text" id="" class="fadeIn third" name="numEtage" placeholder="numEtage" value="<?=isset($restor[0]->idchambre)?$restor[0]->numetage:'' ?>">
                    <?php if(isset($arrErrors['numEtage'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['numEtage']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <select class="select" name="typeChambre" id="" >
                        <option value="<?=isset($restor[0]->idchambre)?$restor[0]->typechambre:'select' ?>"><?=isset($restor[0]->idchambre)?$restor[0]->typechambre:'Sélectionner le type de chambre' ?></option>
                        <option value="individuel">individuel</option>
                        <option value="duo">à deux</option>
                    </select>
                    <?php if(isset($arrErrors['typeChambre'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['typeChambre']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <select class="select" name="idPavillon" id="" >
                        <option value="<?=isset($restorPavillons[0]->idpavillon)?$restorPavillons[0]->idpavillon:'Affecter à un pavilon (facultatif)'?>"><?=$restorPavillons[0]->numpavillon?></option>
                        <?php foreach($pavillons as $pavillon):?>
                            <option value="<?=$pavillon->idpavillon?>"><?=$pavillon->numpavillon?></option>
                        <?php endforeach ?>
                    </select>
            </div>
           <!-- <div class="form-group">
                    <select class=" select" name="pavillon" id="" >
                        <option value="select">Affecter à un pavilon (facultatif)</option>
                        <?php foreach($test as $pavillon):?>
                            <option value="<?=$pavillon->idpavillon?>"><?=$pavillon->numpavillon?></option>
                        <?php endforeach ?>
                    </select>
            </div> -->
            <input type="submit" class="fadeIn fourth" value="Se connecter">
        </form>
    </div>
</div>