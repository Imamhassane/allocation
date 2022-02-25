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
         
        <form  method="post" action="<?=WEBROOT."etudiant/addEtudiant"?>" id="form" >
            <div class="row">
                <div class="form-group">
                        <input type="text" id="nom" class="fadeIn second" name="nom" placeholder="nom">
                        <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['nom'])?$arrErrors['nom']:''?></small>
                </div>
                <div class="form-group">
                        <input type="text" id="prenom" class="fadeIn third" name="prenom" placeholder="prenom">
                        <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['prenom'])?$arrErrors['prenom']:''?></small>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                        <input type="text" id="login" class="fadeIn second" name="login" placeholder="email">
                        <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['login'])?$arrErrors['login']:''?></small>
                </div>
                <div class="form-group">
                        <input type="date" id="dateNaissance" class="fadeIn third" name="dateNaissance" placeholder="dateNaissance">
                        <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['prenom'])?$arrErrors['dateNaissance']:''?></small>
                </div>
            </div>
            <div class="row">
                    <div class="form-group">
                            <input type="tel" id="telephone" class="fadeIn second" name="telephone" placeholder="telephone">
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['telephone'])?$arrErrors['telephone']:''?></small>
                    </div>

                    <div class="form-group">
                        <select class="select" name="typeEtudiant" id="" onchange="yesnoCheck(this);">
                            <option value="select">Sélectionner le type d'étudiant</option>
                            <option value="nonBoursier">Etudiant non boursier </option>
                            <option value="boursierNL">Etudiant boursier non Logé</option>
                            <option value="boursierLoge">tudiant boursier logé </option>
                        </select>
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['typeEtudiant'])?$arrErrors['typeEtudiant']:''?></small>
                    </div>
            </div>
            <div class="row">
                    <div id ="Section1" class="form-group" style="display: none;">
                        <input type="text" id="" class="fadeIn second" name="adresse" placeholder="adresse">
                        <?php if(isset($arrErrors['adresse'])): ?>
                            <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['adresse']?></small>
                        <?php endif ?>
                    </div>
                    <div class="form-group" id ="Section2" style="display: none;">
                        <select class="select" name="typebourse" id="" >
                            <option value="select">Sélectionner le type de bourse</option>
                            <option value="demi-bourse">Demi-bourse</option>
                            <option value="bourse-entiere">Bourse entière </option>
                        </select>
                        <?php if(isset($arrErrors['typebourse'])): ?>
                            <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['typebourse']?></small>
                        <?php endif ?>
                    </div>
            </div>
            <div class="row" id ="Section3" style="display: none;" >
                    <div class="form-group">
                        <select class="select" name="typebourse" id="" >
                            <option value="select">Sélectionner le type de bourse</option>
                            <option value="demi-bourse">Demi-bourse</option>
                            <option value="bourse-entiere">Bourse entière </option>
                        </select>
                            <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['typebourse'])?$arrErrors['typebourse']:''?></small>
                    </div>
                        <div class="form-group">
                            <select class="select" name="chambreEtu" id="" >
                                <option value="select">Affecter à une chambre </option>
                                <?php foreach($chambres as $chambre):?>
                                    <option value="<?=$chambre->idchambre?>"><?='chambre '.$chambre->numchambre.' , pavillon '.$chambre->numpavillon?></option>
                                <?php endforeach ?>
                            </select>
                                <small id="emailHelp"  class="form-text text-danger"><?=isset($arrErrors['chambreEtu'])?$arrErrors['chambreEtu']:''?></small>
                        </div>
            </div>

            <input type="submit" class="fadeIn fourth" value="Ajouter">
        </form>

  
    </div>
</div>

<script>
    const form = document.getElementById('form');
    const nom = document.getElementById('nom');
    const prenom = document.getElementById('prenom');
    const login = document.getElementById('login');
    const dateNaissance = document.getElementById('dateNaissance');
    const telephone = document.getElementById('telephone');
    const typeEtudiant = document.getElementById('typeEtudiant');

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
        var bool = checkRequired([nom ,prenom ,login ,dateNaissance ,telephone ,typeEtudiant]);
        if(!bool){
            e.preventDefault();//Bloquer la soumission du formulaire
        }
    //
    // checkLength(username, 3, 15);
    // checkEmail(email);

    });

</script>