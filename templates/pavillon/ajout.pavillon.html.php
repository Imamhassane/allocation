<?php
use App\Core\Session;
$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}
?>
 <div class="container wrapper fadeInDown addCham" >
    <div id="formConten">
    <h2 class="active"> Ajouter un Pavillon</h2>
        <form method="post"  action="<?=WEBROOT."pavillon/addPavillon"?>" id="form">
        <input type="hidden" name="id"      value="<?=isset($restor[0]->idpavillon)?$restor[0]->idpavillon:'' ?>">        
                <div class="form-group">
                        <input type="text" id="numPavillon"  placeholder="numPavillon" class="fadeIn second" name="numPavillon" value="<?php 
                                                                                                                                                if (isset($restor[0]->idpavillon)){
                                                                                                                                                        echo $restor[0]->numpavillon;
                                                                                                                                                        }elseif(Session::keyExist("numPavillon")){
                                                                                                                                                            echo Session::getSession("numPavillon");
                                                                                                                                                            }else{
                                                                                                                                                                echo '';
                                                                                                                                                                } ?>">
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['numPavillon'])?$arrErrors['numPavillon']:''?></small>
                </div>
                <div class="form-group">
                        <input type="text" id="nbreEtage" class="fadeIn third" name="nbreEtage" placeholder="nbreEtage" value="<?php
                                                                                                                                        if(isset($restor[0]->idpavillon)){
                                                                                                                                                echo $restor[0]->nbreetage;
                                                                                                                                        }elseif(Session::keyExist("nbreEtage")){
                                                                                                                                                echo Session::getSession("nbreEtage");
                                                                                                                                        }else{
                                                                                                                                                echo '';
                                                                                                                                        } ?>">
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['nbreEtage'])?$arrErrors['nbreEtage']:''?></small>
                </div> 
                    <div class="form-group">
                        <select class="select" name="chooseChambre" id="" onchange="yesnoCheck(this);">
                            <option value="select">Affecter ou Ajouter des chambres</option>
                            <option value="affect">Affecter des chambre</option>
                            <option value="add">Créer une nouvelle chambre</option>
                        </select>
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['typeEtudiant'])?$arrErrors['typeEtudiant']:''?></small>
                    </div>       
            
               
            
                <div class="mid form-group chambre" id="affecter" style="display: none;">
                    <?php foreach($chambres as $chambre):?>
                            <span for=""><?=$chambre->numchambre?></span>
                            <input type="checkbox" id="vehicle1" name="chambre[]" value="<?=$chambre->idchambre?>">
                    <?php endforeach ?>
                </div>
            
                <div class="mid" id="ajouter" style="display: none;" >
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
            <input type="submit" id="input" class="fadeIn fourth" value="<?=isset($restor[0]->idpavillon)?'Modifier':'Ajouter'?>">
        </form>
    </div>
</div> 
<?php
    Session::removeKey("numPavillon");
    Session::removeKey("nbreEtage");
?>
<script>


    function yesnoCheck(that) {
        

        if(that.value == "affect"){
            document.getElementById("affecter").style.display = "block";
        }else{
            document.getElementById("affecter").style.display = "none";
        }

        if(that.value == "add"){
            document.getElementById("ajouter").style.display = "flex";
        }else{
            document.getElementById("ajouter").style.display = "none";
        }

      }
    const form = document.getElementById('form');
    const username = document.getElementById('numPavillon');
    const email = document.getElementById('nbreEtage');

    //Functions-------------------------------------------------------------
    function showError(input, message) {//Afficher les messages d'erreur
        const formGroup = input.parentElement;
        formGroup.className = 'form-group error';
        const small = formGroup.querySelector('small');
        small.innerText = message;
    }
    //
    function showSuccess(input) {
        const formGroup = input.parentElement;
        formGroup.className = 'form-group success'; 
    }
    //
    function checkEmail(input) {//Tester si l'email est valide :  javascript : valid email
        const re = [0-9]
        if (re.test(input.value.trim().toLowerCase())) {
            showSuccess(input);
        } else {
            showError(input,`doit être numérique!`);
        }
    }
    //
    function getFieldName(input) {//Retour le nom de chaque input en se basant sur son id
        return input.id.charAt(0).toUpperCase() + input.id.slice(1);
    }
    function checkRequired(inputArray) {// Tester si les champs ne sont pas vides
        var bool =false
        inputArray.forEach(input => {
            if (input.value.trim() === '') {
                showError(input,`${getFieldName(input)} est obligatoire`);
            }else{
                showSuccess(input);
                bool = true;

            }
    });
    return bool;
    }
    //

    //
    function checkLength(input, min, max) {//Tester la longueur de la valeur  d'un input
        if(input.value.length < min){
            showError(input, `${getFieldName(input)} must be at least ${min} characters!`)
        }else if(input.value.length > max){
            showError(input, `${getFieldName(input)} must be less than ${max} characters !`);
        }else{
            showSuccess(input);
        }
    }
    //

    //Even listeners--------------------------------------------------------
    form.addEventListener('submit',function(e){
       var bool = checkRequired([username, email]);
        if(!bool){
            e.preventDefault();//Bloquer la soumission du formulaire
        }
    //
    // checkLength(username, 3, 15);
    // checkEmail(email);

    });

</script>
