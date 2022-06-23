<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <?php
    flash('candidat_message');
    ?>
    <!-- BEGIN page-header -->
    <div class="page-header d-flex justify-content-between">
        <span class="me-3">Candidats</span>
        <a href="<?= URLROOT ?>/candidats/add" class="btn btn-success btn-sm btn-rounded px-4">
            <i class="fa fa-plus fa-lg me-2 ms-n2 text-success-900"></i> Ajouter
        </a>
    </div>
    <!-- END page-header -->

    <div class="col-xl-12 panel panel-inverse">
        <!-- BEGIN panel -->
        <?php if (count($data['candidats']) > 0) : ?>

            <div class="">
                <div class="row m-2 mt-3">
                    <form class="col-4 d-flex justify-content-start align-items-center" action="<?= URLROOT ?>/candidats" method="POST">
                        <span class="text-nowrap mx-2">Nombre de rangées:</span>
                        <select class="form-select form-select-sm w-25" name="row-nbr">
                            <option value="1">10</option>
                            <option value="2">20</option>
                            <option value="5">50</option>
                            <option value="10">100</option>
                            <option value="25">250</option>
                            <option value="50">500</option>
                        </select>
                        <button class="btn btn-sm mx-2" type="submit" style="color: #00acac; border: #00acac 1.2px solid;">Appliquer</button>
                    </form>
                </div>
                <!-- BEGIN panel-body -->
                <div class="panel-body">
                    <div class="table-responsive mb-4">
                        <table id="data-table-fixed-columns" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="2">#</th>
                                    <th class="text-nowrap">Username</th>
                                    <th class="text-nowrap">Nom</th>
                                    <th class="text-nowrap">Phone</th>
                                    <th class="text-nowrap">CIN</th>
                                    <th class="text-nowrap">Permis</th>
                                    <th class="text-nowrap">Date d'incris</th>
                                </tr>
                            </thead>
                            <tbody class="fs-5">
                                <?php $i = 0;
                                foreach ($data['candidats'] as $row) : $i++; ?>
                                    <tr>
                                        <th><?= $i ?></th>
                                        <td class="text-nowrap">
                                            <img width="40" height="40" class="rounded" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="">
                                        </td>
                                        <td class="text-nowrap"><?= $row['username'] ?></td>
                                        <td class="">
                                            <strong class="text-nowrap">
                                                <?= $row['nom_fr'] . ' ' . $row['prenom_fr'] ?>
                                            </strong>
                                            <p class="text-nowrap"><a class="text-decoration-none text-info fs-6" href="mailTo:<?= $row['email'] ?>"><?= $row['email'] ?></a></p>
                                        </td>
                                        <td class="text-nowrap"><?= $row['phone'] ?></td>
                                        <td class="text-nowrap"><?= $row['cin'] ?></td>
                                        <td class="text-nowrap text-center">
                                            <span class="text-white border rounded-2 px-2 py-1
                                            <?php
                                            if ($row['Categorie'] == 'A') : echo 'bg-primary';
                                            elseif ($row['Categorie'] == 'A1') : echo 'bg-primary';
                                            elseif ($row['Categorie'] == 'B') : echo 'bg-danger';
                                            elseif ($row['Categorie'] == 'C') : echo 'bg-warning';
                                            elseif ($row['Categorie'] == 'D') : echo 'bg-success';
                                            elseif ($row['Categorie'] == 'EB') : echo 'bg-danger';
                                            elseif ($row['Categorie'] == 'EC') : echo 'bg-warning';
                                            elseif ($row['Categorie'] == 'EC') : echo 'bg-success';
                                            endif;
                                            ?>">
                                                <?= $row['Categorie'] ?></span>
                                        </td>
                                        <td class="text-nowrap py-0">
                                            <small class="fs-6 m-0 d-flex justify-content-end"><?= date_format(date_create($row['dateCreate']), "H:i"); ?></small>
                                            <p class="text-secondary m-0"><?= date_format(date_create($row['dateCreate']), "d-m-Y"); ?></p>
                                        </td>
                                        <td class="text-nowrap" nowrap>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-white btn-sm">Plus</a>
                                                <a href="#" class="btn btn-white btn-sm dropdown-toggle no-caret" data-bs-toggle="dropdown"><span class="caret"></span> </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="<?= URLROOT ?>/candidats/edit/<?= $row['candidatId'] ?>" class="dropdown-item text-warning"><i class="fa fa-edit me-2"></i> Modifier</a>
                                                    <div class="dropdown-divider"></div>
                                                    <?php if ($row['status'] == 0) : ?>
                                                        <a href="<?= URLROOT ?>/candidats/activate/<?= $row['userId'] ?>" class="dropdown-item text-success"><i class="fa-solid fa-eye me-2"></i>Active</a>
                                                        <div class="dropdown-divider"></div>
                                                    <?php else : ?>
                                                        <a href="<?= URLROOT ?>/candidats/desactivate/<?= $row['userId'] ?>" class="dropdown-item text-primary"><i class="fa-solid fa-eye-slash text-dnager me-2"></i> Desactiver</a>
                                                    <?php endif ?>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="<?= URLROOT ?>/candidats/delete" class="dropdown-item text-danger"><i class="fa fa-trash me-2"></i> Supprimer</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="<?= URLROOT ?>/candidats/paye/<?= $row['userId'] ?>" class="dropdown-item text-success"><i class="fa-solid fa-comment-dollar me-2"></i> Ajouter Payement</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END panel-body -->
            </div>

        <?php else : ?>
            <div class="text-center my-4">
                <h3> Aucune Candidats trouvée</h3>
                <p>
                    Aucune Candidats ne correspond à vos filtres actuels.
                    Essayez de supprimer certains d'entre eux pour obtenir de meilleurs résultats.
                </p>
            </div>
        <?php endif; ?>
        <!-- END panel -->
    </div>

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>