<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header">
        <span class="me-3">Candidats</span>
        <a href="<?= URLROOT ?>/candidats/add" class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter</a>
    </h1>
    <!-- END page-header -->

    <div class="col-xl-12 panel panel-inverse">
        <!-- BEGIN panel -->
        <?php if(count($data['candidats']) > 0) :?>
        
        <div class="">
            <div class="row m-2 mt-3">
                <form class="col-4 d-flex justify-content-start align-items-center">
                    <span class="text-nowrap mx-2">Nombre de rangées:</span>
                    <select class="form-select form-select-sm w-25" name="row-nbr">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="Tous">Tous</option>
                    </select>
                    <button class="btn btn-sm mx-2" type="submit" style="color: #00acac; border: #00acac 1.2px solid;">Appliquer</button>
                </form>
            </div>
            <!-- BEGIN panel-body -->
            <div class="panel-body table-responsive">
                <table id="data-table-fixed-columns" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">Nom</th>
                            <th class="text-nowrap">Prénom</th>
                            <th class="text-nowrap">E-mail</th>
                            <th class="text-nowrap">Phone</th>
                            <th class="text-nowrap">CIN</th>
                            <th class="text-nowrap">Categorie De Permis</th>
                            <th class="text-nowrap">Date d'incris</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['candidats'] as $row) : ?>
                            <tr>
                                <th><?= $row['id'] ?></th>
                                <td class="text-nowrap"><?= $row['username'] ?></td>
                                <td class="text-nowrap"><?= $row['nom_fr'] ?></td>
                                <td class="text-nowrap"><?= $row['prenom_fr'] ?></td>
                                <td class="text-nowrap"><?= $row['email'] ?></td>
                                <td class="text-nowrap"><?= $row['phone'] ?></td>
                                <td class="text-nowrap"><?= $row['cin'] ?></td>
                                <td class="text-nowrap"><?= $row['Categorie'] ?></td>
                                <td class="text-nowrap"><?= $row['dateInscris'] ?></td>
                                <td class="text-nowrap">action</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- END panel-body -->
        </div>
        
        <?php else:?>
        <div class="text-center my-4">
            <h3> Aucune Candidats trouvée</h3>
            <p>
                Aucune Candidats ne correspond à vos filtres actuels. 
                Essayez de supprimer certains d'entre eux pour obtenir de meilleurs résultats.
            </p>
        </div>
        <?php endif ;?>
        <!-- END panel -->
    </div>

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>