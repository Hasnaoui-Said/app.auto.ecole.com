<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <h1 class="page-header">
        <span class="me-3">Groups</span>
        <a href="<?= URLROOT?>/candidats/add" 
        class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter</a>
    </h1>
    <!-- END page-header -->

    <div class="row">
        <?php foreach ($data['groups'] as $row) : ?>
        <div class="col-xs-12 col-md-6">
            <!-- BEGIN panel -->
            <div class="panel panel-inverse">
                <div class="row m-2 mt-3">
                    <div class="d-flex justify-content-start align-items-start flex-column">
                        <h4> <small>Nom du group :</small> <?= $row['nomGroup'] ?> </h4>
                        <p><?= date_format(date_create($row['dateCreate']),"d-m-Y");?></p>
                    </div>
                </div>
                <div class="panel panel-inverse" data-sortable-id="table-basic-6">
                            <!-- BEGIN panel-body -->
                            <div class="panel-body">
                                <!-- BEGIN table-responsive -->
                                <h1 class="page-header">
                                    <span class="me-3">Listee des candidats: </span>
                                    <a href="<?= URLROOT?>/candidats/add" 
                                    class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter des Candidats</a>
                                </h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>CIN</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $i= 0; 
                                            foreach ($data['candidatsGrp'] as $cdGrp) : $i++;
                                            if($cdGrp['idGroup'] == $row['id']): ?>
                                                <tr>
                                                    <th><?= $i ?></th>
                                                    <td class="text-nowrap"><?= $cdGrp['username'] ?></td>
                                                    <td class="text-nowrap"><?= $cdGrp['email'] ?></td>
                                                    <td class="text-nowrap"><?= $cdGrp['cin'] ?></td>
                                                    <td class="text-nowrap">action</td>
                                                </tr>
                                            <?php endif;
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END table-responsive -->
                            </div>
                            <!-- END panel-body -->
                        </div>
            </div>
                <!-- END panel -->
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>