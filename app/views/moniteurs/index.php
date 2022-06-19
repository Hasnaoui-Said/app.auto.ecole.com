<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <?php
    flash('moniteur_message');
    ?>
    <!-- BEGIN page-header -->
    <h1 class="page-header">
        <span class="me-3">Moniteurs</span>
        <a href="<?= URLROOT ?>/moniteurs/add" class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter</a>
    </h1>
    <!-- END page-header -->

    <div class="col-xl-12">
        <?php if (count($data['moniteurs']) > 0) : ?>
            <!-- BEGIN panel -->
            <div class="panel panel-inverse">
                <div class="row m-2 mt-3">
                    <form class="col-4 d-flex justify-content-start align-items-center" action="<?= URLROOT ?>/moniteurs" method="POST">
                        <span class="text-nowrap mx-2">Nombre de rangées:</span>
                        <select class="form-select form-select-sm w-25" name="row-nbr">
                            <option <?= $data['limit'] == 1 ? 'selected' : '' ?> value="1">10</option>
                            <option <?= $data['limit'] == 2 ? 'selected' : '' ?> value="2">20</option>
                            <option <?= $data['limit'] == 5 ? 'selected' : '' ?> value="5">50</option>
                            <option <?= $data['limit'] == 10 ? 'selected' : '' ?> value="10">100</option>
                            <option <?= $data['limit'] == 25 ? 'selected' : '' ?> value="25">250</option>
                            <option <?= $data['limit'] == 50 ? 'selected' : '' ?> value="50">500</option>
                        </select>
                        <button class="btn btn-sm mx-2" type="submit" style="color: #00acac; border: #00acac 1.2px solid;">Appliquer</button>
                    </form>
                </div>
                <!-- END panel-body -->
                <div class="table-responsive mb-4">
                    <table id="data-table-fixed-columns" class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th colspan="2">Id</th>
                                <th class="text-nowrap">Username</th>
                                <th class="text-nowrap">Nom</th>
                                <th class="text-nowrap">Phone</th>
                                <th class="text-nowrap">CPA</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Date inscris</th>
                                <th class="text-nowrap" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="fs-5">
                            <?php $i = 0;
                            foreach ($data['moniteurs'] as $row) : $i++; ?>
                                <tr>
                                    <th><?= $i ?></th>
                                    <td class="text-nowrap">
                                        <img width="40" height="40" class="rounded" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="">
                                    </td>
                                    <td class="text-nowrap"><?= $row['username'] ?></td>
                                    <td class="">
                                        <strong class="text-nowrap">
                                            <?= $row['nom'] . ' ' . $row['prenom'] ?>
                                        </strong>
                                        <p class="text-nowrap"><a class="text-decoration-none text-info fs-6" href="mailTo:<?= $row['email'] ?>"><?= $row['email'] ?></a></p>
                                    </td>
                                    <td class="text-nowrap"><?= $row['phone'] ?></td>
                                    <td class="text-nowrap text-center">
                                        <p class=""><?= $row['num_cpa'] ?></p>
                                        <small class="fs-6"><?= $row['date_cpa'] ?></small>
                                    </td>
                                    <td class="text-nowrap"><?= $row['type'] ?></td>
                                    <td class="text-nowrap py-0">
                                        <small class="fs-6 m-0 d-flex justify-content-end"><?= date_format(date_create($row['dateCreate']), "H:i"); ?></small>
                                        <p class="text-secondary m-0"><?= date_format(date_create($row['dateCreate']), "d-m-Y"); ?></p>
                                    </td>
                                    <td class="text-nowrap" nowrap>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-white btn-sm">Plus</a>
                                            <a href="#" class="btn btn-white btn-sm dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="caret"></span> </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="<?= URLROOT; ?>/moniteurs/edit/<?= $row['id']; ?>" class="dropdown-item text-warning"><i class="fa fa-edit me-2"></i> Modifier</a>
                                                <div class="dropdown-divider"></div>
                                                <?php if ($row['status'] == 0) : ?>
                                                    <a href="<?= URLROOT ?>/moniteurs/activate/<?= $row['id'] ?>" class="dropdown-item text-success"><i class="fa-solid fa-eye me-2"></i>Active</a>
                                                    <div class="dropdown-divider"></div>
                                                <?php else : ?>
                                                    <a href="<?= URLROOT ?>/moniteurs/desactivate/<?= $row['id'] ?>" class="dropdown-item text-primary"><i class="fa-solid fa-eye-slash text-dnager me-2"></i> Desactiver</a>
                                                <?php endif ?>
                                                <div class="dropdown-divider"></div>
                                                <a href="<?= URLROOT ?>/moniteurs/delete/<?= $row['id'] ?>" class="dropdown-item text-danger"><i class="fa fa-trash me-2"></i> Supprimer</a>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END panel -->

        <?php else : ?>
            <div class="text-center my-4">
                <h3> Aucune Candidats trouvée</h3>
                <p>
                    Aucune Candidats ne correspond à vos filtres actuels.
                    Essayez de supprimer certains d'entre eux pour obtenir de meilleurs résultats.
                </p>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>