<?php 
if($url[0]=='chambre'):?>
     <a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-2  " href="<?= WEBROOT . 'chambre/addChambre' ?>" role="button">Ajouter +</a>
     <a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-2  " href="<?= WEBROOT . 'chambre/listeChambre' ?>" role="button">Listes des archivées</a>

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
                <?php if($url[0]=='chambre'):?>
                    <th>Pavillon</th>
                    <th>Voir les étudiants</th>
                    <th>Modifier</th>
                    <th>Archiver</th>
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
                    <td>
                        <a href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                        archiver <i class="fa fa-archive"></i>
                        </a>
                    </td>
                  
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
                        <a href="<?= WEBROOT . 'chambre/edit/'.$chambre->idchambre ?>">
                            modifier <i class="fa fa-edit"></i>
                        </a>
                    </td>    
                    <td>
                        <a href="<?= WEBROOT . 'chambre/archive/'.$chambre->idchambre ?>">
                        archiver <i class="fa fa-archive"></i>
                        </a>
                    </td>
                  
                </tr>
            <?php endforeach?>
                  
            <?php foreach ($chambrepavillon as $chambre):?>
                <tr>
                    <td><?=$chambre->numchambre?></td>
                    <td><?=$chambre->numetage?></td>
                    <td><?=$chambre->typechambre?></td>
                  
                </tr>

            <?php endforeach?>
        </tbody>
    </table>

    <div class="pagination mt-2 mb-5 ml-5">    
                            <?php  
                            
                                if($per_page_record == 0){
                                    $total_pages = $total_records / 1;     

                                }else{
                                    $total_pages = $total_records / $per_page_record;     

                                }
                                //$total_pages = round($total_pages);
                                //var_dump($total_pages);

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