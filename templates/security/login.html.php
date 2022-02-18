<?php

use App\Core\Session;
$arrErrors=[];
if(Session::keyExist("errors")){
    $arrErrors=Session::getSession("errors");
    Session::removeKey("errors");
}
?>
<div class="container wrapper fadeInDown" >
  <div id="formContent">
    <h2 class="active"> Login Form</h2>
    <form method="post" action="<?=WEBROOT."security/seConnecter"?>">
      <?php if(isset($arrErrors['connexion'])): ?>
        <div class="alert alert-danger" role="alert">
          <strong> <?=$arrErrors['connexion']?></strong>
        </div>
      <?php endif ?>
      <div class="form-group">
            <input type="text" id="" class="fadeIn second" name="login" placeholder="login">
            <?php if(isset($arrErrors['login'])): ?>
              <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['login']?></small>
            <?php endif ?>
      </div>
      <div class="form-group">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <?php if(isset($arrErrors['password'])): ?>
              <small id="emailHelp"  class="form-text text-danger"><?=$arrErrors['password']?></small>
            <?php endif ?>
      </div>
      <input type="submit" class="fadeIn fourth" value="Se connecter">
    </form>
  </div>
</div>