                    <form method="POST" action="<?=WEBROOT."etudiant/listeEtudiant"?>" class="form-inline  mt-2 ml-2">
                        <div class="form-group ml-2">
                            <div class="form-group">
                                <label for="">Chambre</label>
                                <select class="form-control ml-2" name="chambre" id="" value="">
                                <?php foreach ($chambres as $chambre):?>
                                    <option value="<?=$chambre->idchambre?>"><?='chambre '.$chambre->numchambre.' pavillon '.$chambre->numpavillon?></option>;
                                <?php endforeach?>   
                                </select>
                            </div>
                        </div>
                        <button name="ok" class="ml-3 ">OK</button>
                    </form>
   <table class="content-table">
        <thead>
            <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Matricule</th>
                <?php if($url[0]=='etudiant'):?>
                    <th>Adresse</th>
                <?php endif?>
                <th>Type de bourse</th>
                <?php if($url[0]=='etudiant'):?>
                    <th>Chambre</th>
                <?php endif?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant):?>
                <tr>
                    <td><?=$etudiant->prenom?></td>
                    <td><?=$etudiant->nom?></td>
                    <td><?=$etudiant->matricule?></td>
                    <td>
                        <?php
                            if($etudiant->adresse==null){
                                echo '-';
                            }else{
                                echo $etudiant->adresse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->typebourse==null){
                                echo '-';
                            }else{
                                echo $etudiant->typebourse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->idchambre==null){
                                echo '-';
                            }else{
                                echo $etudiant->idchambre;
                            }
                        ?>
                    </td>

                </tr>
            <?php endforeach?>
            <?php foreach ($etuloges as $etudiant):?>
                <tr>
                    <td><?=$etudiant->prenom?></td>
                    <td><?=$etudiant->nom?></td>
                    <td><?=$etudiant->matricule?></td>
                    <td>
                        <?php
                            if($etudiant->adresse==null){
                                echo '-';
                            }else{
                                echo $etudiant->adresse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->typebourse==null){
                                echo '-';
                            }else{
                                echo $etudiant->typebourse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->idchambre==null){
                                echo '-';
                            }else{
                                echo 'chambre '.$etudiant->numchambre.' pavillon '.$etudiant->numpavillon;
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach?>
            <?php foreach ($getEtudiant as $etudiant):?>
                <tr>
                    <td><?=$etudiant->prenom?></td>
                    <td><?=$etudiant->nom?></td>
                    <td><?=$etudiant->matricule?></td>

                    <td>
                        <?php
                            if($etudiant->typebourse==null){
                                echo '-';
                            }else{
                                echo $etudiant->typebourse;
                            }
                        ?>
                    </td>

                </tr>

            <?php endforeach?>
        </tbody>
    </table>
