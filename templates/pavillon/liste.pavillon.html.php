<a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-4  " href="<?= WEBROOT . 'pavillon/ajoutPavillon' ?>" role="button">Ajouter +</a>


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
