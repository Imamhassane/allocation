
    <a name="" id="" class="btn btn-success ml-auto  mb-3 float-right mt-4  " href="<?= WEBROOT . 'chambre/addChambre' ?>" role="button">Ajouter +</a>

    <table class="content-table">
        <thead>
            <tr class="tittle">
                <th>aa </th>
            </tr>
            <tr>
                <th>Numéro chambre</th>
                <th>Numéro Etage</th>
                <th>Type de chambre</th>
                <th>Voir les étudiants</th>
                <th>Modifier</th>
                <th>Archiver</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chambres as $chambre):?>
                <tr>
                    <td><?=$chambre->numchambre?></td>
                    <td><?=$chambre->numetage?></td>
                    <td><?=$chambre->typechambre?></td>
                    <td class="detail">
                        <a name="" id="" class="btn1 text-white " 
                            href="#" role="button">Voir+</a>
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
        </tbody>
    </table>
