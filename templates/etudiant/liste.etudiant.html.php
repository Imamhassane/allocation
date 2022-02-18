    <table class="content-table">
        <thead>
            <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Matricule</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Type de bourse</th>
                <th>Chambre</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant):?>
                <tr>
                    <td><?=$etudiant->prenom?></td>
                    <td><?=$etudiant->nom?></td>
                    <td><?=$etudiant->login?></td>
                    <td><?=$etudiant->matricule?></td>
                    <td><?=$etudiant->datenaissance?></td>
                    <td><?=$etudiant->telephone?></td>
                    <td>
                        <?php
                            if($etudiant->adresse==null){
                                echo 'Pas d\'adresse';
                            }else{
                                echo $etudiant->adresse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->typebourse==null){
                                echo 'Non boursier';
                            }else{
                                echo $etudiant->typebourse;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($etudiant->idchambre==null){
                                echo 'Non logé';
                            }else{
                                echo $etudiant->idchambre;
                            }
                        ?>
                    </td>

                </tr>
            <?php endforeach?>
        </tbody>
    </table>
