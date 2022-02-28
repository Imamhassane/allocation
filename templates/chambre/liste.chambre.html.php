<?php if($url[1]=='listeChambre'):?>
     <a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-2  " href="<?= WEBROOT . 'chambre/addChambre' ?>" role="button">Ajouter +</a>
     <a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-2  " href="<?= WEBROOT . 'chambre/ChambreArchivee' ?>" role="button">Listes des archivées</a>
     <form method="POST" action="<?=WEBROOT."chambre/listeChambre"?>" class="form-inline  mt-2 ml-4">
                            <div class="form-group ml-5">
                                <div class="form-group">
                                    <label for="">Pavillon</label>
                                    <select class="form-control ml-2" name="chambre" id="" value="">
                                    <?php foreach ($pavillons  as $pavillon):?>
                                        <option value="<?=$pavillon->idpavillon?>"><?=' pavillon '.$pavillon->numpavillon?></option>;
                                    <?php endforeach?>   
                                    </select>
                                </div>
                            </div>
                            
                            <button name="ok" class="ml-3 ">OK</button>
                        </form>
<?php endif ?>


    <table class="content-table" id="">
        <thead>
            <tr class="tittle">
                <th></th>
            </tr>
            <tr>
                <th>Numéro chambre</th>
                <th>Numéro Etage</th>
                <th>Type de chambre</th>
                <?php if($url[1]=='listeChambre'):?>
                    <th>Pavillon</th>
                    <th>Voir les étudiants</th>
                    <th>Modifier</th>
                    <th>Archiver</th>
                <?php endif ?>
                <?php if($url[1]=='ChambreArchivee'):?>
                    <th>Pavillon</th>
                    <th>Voir les étudiants</th>
                    <th>Modifier</th>
                    <th>Desarchiver</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chambres as $chambre):?>
                <tr>
                    <td><?=$chambre->numchambre?></td>
                    <td><?=$chambre->numetage?></td>
                    <td><?=$chambre->typechambre?></td>
                    <td>-</td>
                    <td class="detail">
                        <a name="" id="" class="btn1 text-white " 
                            href="<?= WEBROOT . 'chambre/chambreEtudiant/'.$chambre->idchambre ?>" role="button">Voir+</a>
                    </td>

                    <td>
                        <a href="<?= WEBROOT . 'chambre/edit/'.$chambre->idchambre ?>">
                            modifier <i class="fa fa-edit"></i>
                        </a>
                    </td>    

                    <?php if($url[1]=='listeChambre'):?>
                        <td class="archi">
                            <a class="archive_button" href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                            archiver <i class="fa fa-archive"></i>
                            </a>
                        </td>
                    <?php endif ?>

                    <?php if($url[1]=='ChambreArchivee'):?>
                        <td class="archi">
                            <a class="dearchive_button" href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                            Desarchiver <i class="fa fa-archive"></i>
                            </a>
                        </td>
                    <?php endif ?>

                </tr>
            <?php endforeach?>
            <?php foreach ($ChambreAndPavillon as $chambre):?>
                <tr>
                    <td><?=$chambre->numchambre?></td>
                    <td><?=$chambre->numetage?></td>
                    <td><?=$chambre->typechambre?></td>
                    <td><?=$chambre->numpavillon?></td>
                    <td class="detail">
                        <a name="" id="" class="btn1 text-white " 
                            href="<?= WEBROOT . 'chambre/chambreEtudiant/'.$chambre->idchambre ?>" role="button">Voir+</a>
                    </td>

                    <td>
                        <a  href="<?= WEBROOT . 'chambre/edit/'.$chambre->idchambre ?>">
                            modifier <i class="fa fa-edit"></i>
                        </a>
                    </td>   

                    <?php if($url[1]=='listeChambre'):?>
                        <td class="archi">
                            <a class="archive_button" href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                            archiver <i class="fa fa-archive"></i>
                            </a>
                        </td>
                    <?php endif ?>

                    <?php if($url[1]=='ChambreArchivee'):?>
                        <td class="archi">
                            <a class="dearchive_button" href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                            Desarchiver <i class="fa fa-archive"></i>
                            </a>
                        </td>
                    <?php endif ?>

                </tr>
            <?php endforeach?>
        <?php if($url[1]=='getchambrepavillon'):?>
            <?php foreach ($chambrepavillon as $chambre):?>
                <tr>
                    <td><?=$chambre->numchambre?></td>
                    <td><?=$chambre->numetage?></td>
                    <td><?=$chambre->typechambre?></td>
                  
                </tr>

            <?php endforeach?>
        <?php endif ?>
        </tbody>
    </table>
                    <?php if(!isset($post["ok"])):?>
                        <div class="pagination mt-2 mb-5 ml-5">    
                            <?php  
                            
                                if($per_page_record == 0){
                                    $total_pages = $total_records / 1;     

                                }else{
                                    $total_pages = $total_records / $per_page_record;     

                                }
                                $pagLink = "";                                           
                                if($pages>=2){   
                                    echo "<a href='".WEBROOT."chambre/listeChambre/page=".($pages-1)."'> <span aria-hidden='true'>&laquo;</span></a>";   
                                }       
                                        
                                for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $pages) {   
                                    $pagLink .= "<a class = 'active' href='".WEBROOT."chambre/listeChambre/page="  
                                                                        .$i."'>".$i." </a>";   
                                }               
                                else  {   
                                    $pagLink .= "<a href='".WEBROOT."chambre/listeChambre/page=".$i."'>".$i." </a>";     
                                }   
                                };     
                                echo $pagLink;   
                                if($pages<$total_pages){   
                                    echo "<a href='".WEBROOT."chambre/listeChambre/page=".($pages+1)."'><span aria-hidden='true'>&raquo;</span></a>";   
                                }   
                        
                            ?>    
                        </div> 
                    <?php endif ?>

<script>
    $(document).on('click','.archive_button',function(event){
    
    if(!confirm("Voulez vous vraiment archiver cette chambre ?")) {
       return false;
    }

    });
        $(document).on('click','.dearchive_button',function(event){
        
        if(!confirm("Voulez vous vraiment desarchiver cette chambre?")) {
        return false;
        }

    });
</script>