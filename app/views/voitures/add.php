<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header"><?php echo $data['title']  ?>:</h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body panel p-4">
        <form class="row form-horizontal text-capitalize" action="<?= URLROOT  ?>/vehicules/<?= $data['action']== 'add' ? 'add/': 'edit/'.$data['body']['id'] ?>" method="POST">
            <div class="row m-auto">
                <div class="row ">
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="marque">Marque <sup>*</sup>:</label>
                        <div class="col-lg-8">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['marque_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['marque'])) ? $data['body']['marque'] : ''; ?>" type="text" id="marque" name="marque" placeholder="marque" />
                            <span class="invalid-feedback"><?= $data['body_err']['marque_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="modele">Modele <sup>*</sup>:</label>
                        <div class="col-lg-8">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['modele_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['modele'])) ? $data['body']['modele'] : ''; ?>" type="modele" id="modele" name="modele" placeholder="modele" />
                            <span class="invalid-feedback"><?= $data['body_err']['modele_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="matricule">Matricule <sup>*</sup>:</label>
                        <div class="col-lg-8">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['matricule_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['matricule'])) ? $data['body']['matricule'] : ''; ?>" type="text" id="matricule" name="matricule" placeholder="matricule" />
                            <span class="invalid-feedback"><?= $data['body_err']['matricule_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="date_visite">Date visite technique : </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['date_visite_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['date_visite'])) ? $data['body']['date_visite'] : ''; ?>" id="date_visite" name="date_visite" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['date_visite_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="date_assurance">Date assurance : </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['date_assurance_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['date_assurance'])) ? $data['body']['date_assurance'] : ''; ?>" id="date_assurance" name="date_assurance" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['date_assurance_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="date_vidange">Date vidange: </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['date_vidange_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['date_vidange'])) ? $data['body']['date_vidange'] : ''; ?>" id="date_vidange" name="date_vidange" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['date_vidange_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-md-5 m-auto form-group row my-3">
                    <button class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;"><?= $data['action']== 'add' ? 'Ajouter': 'modifier' ?> </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>