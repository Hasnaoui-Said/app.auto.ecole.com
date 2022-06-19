<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<style>
    .bodycontainer {
        max-height: 200px;
        width: 100%;
        margin: 0;
        overflow-y: auto;
    }

    .table-scrollable {
        margin: 0;
        padding: 0;
    }
</style>
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <?php
    flash('payiement_message');
    ?>
    <div class="page-header d-flex justify-content-between">
        <span class="me-3">Payiements</span>
        <a href="<?= URLROOT ?>/payiements/add" class="btn btn-success btn-sm btn-rounded px-4">
            <i class="fa fa-plus fa-lg me-2 ms-n2"></i> Ajouter
        </a>
    </div>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <div class="panel py-4 px-3">
        <h5>Histrique des payiement:</h5>
        <div class="row">
            <div class="col-sm-12 col-md-6 bg-black-50">
                <div class="panel-body">
                    <div class="table-responsive bodycontainer scrollable">
                        <table class="table table-hover table-borderless fs-6 table-scrollable">
                            <thead>
                                <tr class="text-center">
                                    <th class="nowrap">Totale (DHS)</th>
                                    <th>Totale payie (DHS)</th>
                                    <th>Reste (DHS)</th>
                                    <th>Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['payiements'] as $row) : ?>
                                    <tr class="nowarp">
                                        <td><?php echo $row['total']; ?></td>
                                        <td><?php echo $row['totalPayie']; ?></td>
                                        <td><?php echo  $row['total'] - $row['totalPayie'] ?></td>
                                        <td><?php echo $row['nom']; ?></td>
                                        <td>
                                            <a class="w-100 p-3" href="<?= URLROOT ?>/payiements/index/<?= $row['payiementId']; ?>">
                                                <i class="fa-solid fa-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <form action="<?= URLROOT ?>/payiements/add/<?= $data['nameCandidat']['id'] ?>" method="POST" class="row">

                    <div class="col-6 form-group row mb-3">
                        <label class="col-3 col-form-label form-label" for="prix"> Prix (Dhs)<sup>*</sup>:</label>
                        <div class="col-9">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['prix_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['prix'])) ? $data['body']['prix'] : ''; ?>" type="text" min="0" id="prix" name="prix" placeholder="..DHS" />
                            <span class="invalid-feedback"><?= $data['body_err']['prix_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-6 form-group text-end">
                        <button type="submit" class="btn btn-sm btn-info w-50">
                            <i class="fa-solid fa-credit-card text-white me-3"></i>
                            Payie
                        </button>
                    </div>
                </form>
                <div class="panel-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fs-5">Activité récente du: <strong><?= $data['nameCandidat']['nom'] ?></strong> </p>
                    </div>
                    <div class="table-responsive bodycontainer scrollable">
                        <table class="table table-hover table-borderless table-scrollable">
                            <thead class="">
                                <tr>
                                    <th class="nowrap">Totale payie (DHS)</th>
                                    <th>Reste (DHS)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['hystory'] as $row) : ?>
                                    <tr>
                                        <td><sup class="text-success pe-1 fs-5">+</sup><?php echo $row['historyTotalPayie']; ?></td>
                                        <td><sub class="text-danger pe-1 fs-5">-</sub><?php echo $row['reste']; ?></td>
                                        <td class="">
                                            <p class="text-secondary m-0">
                                                <?= date_format(date_create($row['datePayiement']), "Y-m-d"); ?>
                                                <br>
                                                <small class="text-end"><?= date_format(date_create($row['datePayiement']), "H:i"); ?></small>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>