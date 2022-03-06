<?php
use App\Core\Session;
if(Session::keyExist("message")){
    $message = Session::getSession("message");
    if ($message==1) {
        echo'
        <div class="container-fluid p-0">
            <div  id = "message"  class ="alert alert-success text-center text-success">Pavillon ajouter avec succes</div>
        </div>';
    }
}

Session::removeKey("message");

?>
<div class="int">
    <a name="" id="example" class="btn btn-success ml-auto  mb-3 float-right mt-4  " href="<?= WEBROOT . 'pavillon/ajoutPavillon' ?>" role="button">Ajouter +</a>
</div>
<div class="overflow">
    <table class="content-table">
        <thead>
            <tr>
            <th>Numéro pavillon</th>
            <th>Nombre d'étage</th>
            <th>Voir les chambres</th>
            <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pavillons as $pavillon):?>
                <tr>
                    <td><?=$pavillon->numpavillon?></td>
                    <td><?=$pavillon->nbreetage?></td>
                    <td class="detail">
                        <a name="" id="" class="btn1 text-white " 
                            href="<?= WEBROOT . 'pavillon/getchambrepavillon/'.$pavillon->idpavillon ?>" role="button">Voir+</a>
                    </td>
                    <td>
                        <a href="<?= WEBROOT . 'pavillon/edit/'.$pavillon->idpavillon ?>">
                            modifier <i class="fa fa-edit"></i>
                        </a>
                    </td>    
                  
                </tr>

            <?php endforeach?>
        </tbody>
    </table>
</div>
    <div class="pagination mt-2 mb-5 ">    
                            <?php  
                            
                                if($per_page_record == 0){
                                    $total_pages = $total_records / 1;     

                                }else{
                                    $total_pages = $total_records / $per_page_record;     

                                }
                               // $total_pages = round($total_pages);
                              //  var_dump($total_pages);
                                $pagLink = "";                                           
                                if($pages>=2){   
                                    echo "<a href='".WEBROOT."pavillon/listePavillon/page=".($pages-1)."'> <span aria-hidden='true'>&laquo;</span></a>";   
                                }       
                                        
                                for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $pages) {   
                                    $pagLink .= "<a class = 'active' href='".WEBROOT."pavillon/listePavillon/page="  
                                                                        .$i."'>".$i." </a>";   
                                }               
                                else  {   
                                    $pagLink .= "<a href='".WEBROOT."pavillon/listePavillon/page=".$i."'>".$i." </a>";     
                                }   
                                };     
                                echo $pagLink;   
                                if($pages<$total_pages){   
                                    echo "<a href='".WEBROOT."pavillon/listePavillon/page=".($pages+1)."'><span aria-hidden='true'>&raquo;</span></a>";   
                                }   
                        
                            ?>    
                        </div>  