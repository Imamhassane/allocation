<?php
use App\Core\Session;
$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}
?>
<div class="container wrapper fadeInDown" >
    <div id="formConten">
    <h2 class="active"> Ajouter un Pavillon</h2>
        <form method="post" action="<?=WEBROOT."pavillon/addPavillon"?>">
        <input type="hidden" name="id"      value="<?=isset($restor[0]->idpavillon)?$restor[0]->idpavillon:'' ?>">        
            <div class="form-group">
                    <input type="text" id="" class="fadeIn second" name="numPavillon" value="<?=isset($restor[0]->idpavillon)?$restor[0]->numpavillon:'' ?>" placeholder="numPavillon">
                    <?php if(isset($arrErrors['numPavillon'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['numPavillon']?></small>
                    <?php endif ?>
            </div>
            <div class="form-group">
                    <input type="text" id="" class="fadeIn third" name="nbreEtage" placeholder="nbreEtage" value="<?=isset($restor[0]->idpavillon)?$restor[0]->nbreetage:'' ?>">
                    <?php if(isset($arrErrors['nbreEtage'])): ?>
                        <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['nbreEtage']?></small>
                    <?php endif ?>
            </div>
            
            
            <div class="form-group chambre">
                <label for="">Affecter des chambre +</label>
                <?php foreach($chambres as $chambre):?>
                    <span for=""><?=$chambre->numchambre?></span>
                        <input type="checkbox" id="vehicle1" name="chambre[]" value="<?=$chambre->idchambre?>">
                <?php endforeach ?>
            </div>
            <p><a onclick="javascript:ShowHide('HiddenDiv')">Créer une chambre</a></p>
                <div class="mid" id="HiddenDiv" style="display: none;">
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
                                <option value="Duo">à deux</option>
                            </select>
                            <?php if(isset($arrErrors['typeChambre'])): ?>
                                <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['typeChambre']?></small>
                            <?php endif ?>
                    </div>
                </div>
            <input type="submit" class="fadeIn fourth" value="Se connecter">
        </form>
    </div>
</div>