<?php
use App\Core\Session;
if(Session::keyExist("message")){
    $message = Session::getSession("message");
    if ($message==1) {
        echo'
        <div class="container-fluid p-0">
            <div  id = "message"  class ="alert alert-success text-center text-success">Etudiant ajouter avec succes</div>
        </div>';
    }
}

Session::removeKey("message");

?>
                    <?php if($url[0]=='etudiant'):?>
                        <form method="POST" action="<?=WEBROOT."etudiant/listeEtudiant"?>" class="form-inline  mt-2 ml-4 remakeSelct">
                            <div class="form-group ml-5">
                                
                                    <label for="">Chambre</label>
                                    <select class="form-control ml-2" name="chambre" id="" value="">
                                    <option value="">Choisir...</option>
                                    <?php foreach ($chambres as $chambre):?>
                                        <option value="<?=$chambre->idchambre?>"><?='chambre '.$chambre->numchambre.' pavillon '.$chambre->numpavillon?></option>;
                                    <?php endforeach?>   
                                    </select>
                               
                            
                                
                                    <label for="">Bourse</label>
                                    <select class="form-control ml-2" name="bourse" id="" value="">
                                        <option value="">Choisir...</option>
                                        <option value="bourse-entiere">Bourse entière</option>
                                        <option value="demi-bourse">Demi bourse</option>

                                    </select>
                                
                            </div>
                            <button name="ok" class="ml-3 ">OK</button>
                        </form>
                    <?php endif ?>  
<div class="overflow">             
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
        <?php if($url[0]=='chambreEtudiant'):?>
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
        <?php endif ?>
        </tbody>
    </table>
</div>
                    <?php if(!isset($post["ok"])):?>
                        <div class="pagination mt-2 mb-5 ">    
                            <?php  
                            
                                if($per_page_record == 0){
                                    $total_pages = $total_records / 1;     

                                }else{
                                    $total_pages = $total_records / $per_page_record;     

                                }
                                //$total_pages = round($total_pages);
                                $pagLink = "";                                           
                                if($pages>=2){   
                                    echo "<a href='".WEBROOT."etudiant/listeEtudiant/page=".($pages-1)."'> <span aria-hidden='true'>&laquo;</span></a>";   
                                }       
                                        
                                for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $pages) {   
                                    $pagLink .= "<a class = 'active' href='".WEBROOT."etudiant/listeEtudiant/page="  
                                                                        .$i."'>".$i." </a>";   
                                }               
                                else  {   
                                    $pagLink .= "<a href='".WEBROOT."etudiant/listeEtudiant/page=".$i."'>".$i." </a>";     
                                }   
                                };     
                                echo $pagLink;   
                                if($pages<$total_pages){   
                                    echo "<a href='".WEBROOT."etudiant/listeEtudiant/page=".($pages+1)."'><span aria-hidden='true'>&raquo;</span></a>";   
                                }   

                            ?>    
                        </div>  
                    <?php endif ?>