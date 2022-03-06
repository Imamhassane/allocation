<?php
use App\Core\Session;
use Laminas\Stdlib\Message;

$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}
if(Session::keyExist("message")){
    $message = Session::getSession("message");
    if ($message ==0){
        echo'
        <div class="container-fluid p-0">
            <div  id = "message"  class ="alert alert-danger text-center text-danger">Numéro étage indisponible dans ce pavillon </div>
        </div>';
    }
}

?>
<div class="container wrapper fadeInDown addCham" >
    <div id="formConten">
    <h2 class="active"> Ajouter une chambre</h2>
        <form method="post" action="<?=WEBROOT."chambre/ajoutChambre"?>" id="form">
            <input type="hidden" name="id"      value="<?=isset($restor[0]->idchambre)?$restor[0]->idchambre:'' ?>">        

            <div class="form-group">
                    <input type="text" id="numChambre" class="fadeIn second" name="numChambre" placeholder="numChambre" value="<?=isset($restor[0]->idchambre)?$restor[0]->numchambre:'' ?>">
                    <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['numChambre'])?$arrErrors['numChambre']:''?></small>
            </div>
            <div class="form-group">
                    <input type="text" id="numEtage" class="fadeIn third" name="numEtage" placeholder="numEtage" value="<?=isset($restor[0]->idchambre)?$restor[0]->numetage:'' ?>">
                    <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['numEtage'])?$arrErrors['numEtage']:''?></small>
            </div>
            <div class="form-group">
                    <select class="select" name="typeChambre" id="typeChambre" >
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
                        <option value="<?=isset($restorPavillons[0]->idpavillon)?$restorPavillons[0]->idpavillon:'select'?>"><?=isset($restorPavillons[0]->idpavillon)?$restorPavillons[0]->numpavillon:'Affecter à un pavilon (facultatif)'?></option>
                        <?php foreach($pavillons as $pavillon):?>
                            <option value="<?=$pavillon->idpavillon?>"><?=$pavillon->numpavillon?></option>
                        <?php endforeach ?>
                    </select>
            </div>

            <input type="submit" class="fadeIn fourth" value="<?=isset($restor[0]->idchambre)?'Modifier':'Ajouter'?>">
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('form');
    const username = document.getElementById('numChambre');
    const email = document.getElementById('numEtage');
    const type = document.getElementById('typeChambre');

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
            }
            else if (input.value.trim() === 'select') {
                showError(input,`${getFieldName(input)} est obligatoire`);
            }else{
                showSuccess(input);
                bool = true;
            }
        });
        return bool;
    }
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
    //Even listeners--------------------------------------------------------
    form.addEventListener('submit',function(e){
       var bool = checkRequired([username, email,type]);
        if(!bool){
            e.preventDefault();//Bloquer la soumission du formulaire
        }
        //
        // checkLength(username, 3, 15);
        // checkEmail(email);

    });

</script>