<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header">Crée un nouveau group:</h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body panel p-4">
        <form class="row form-horizontal text-capitalize" action="<?= URLROOT . '/candidats/add' ?>" method="POST">
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
                        <label class="col-lg-4 col-form-label form-label" for="model">Model <sup>*</sup>:</label>
                        <div class="col-lg-8">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['model_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['model'])) ? $data['body']['model'] : ''; ?>" type="model" id="model" name="model" placeholder="E-mail" />
                            <span class="invalid-feedback"><?= $data['body_err']['model_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="Matricule">Matricule <sup>*</sup>:</label>
                        <div class="col-lg-8">
                            <input class="form-control-sm form-control <?= (!empty($data['body_err']['Matricule_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['Matricule'])) ? $data['body']['Matricule'] : ''; ?>" type="text" id="Matricule" name="Matricule" placeholder="Matricule" />
                            <span class="invalid-feedback"><?= $data['body_err']['Matricule_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="datenaiss">Date visite technique : </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['datenaiss_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['datenaiss'])) ? $data['body']['datenaiss'] : ''; ?>" id="datenaiss" name="datenaiss" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['datenaiss_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="datenaiss">Date assurance : </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['datenaiss_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['datenaiss'])) ? $data['body']['datenaiss'] : ''; ?>" id="datenaiss" name="datenaiss" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['datenaiss_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 form-group row mb-3">
                        <label class="form-label col-form-label col-lg-5" for="datenaiss">Date vidange: </label>
                        <div class="col-lg-7">
                            <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['datenaiss_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['datenaiss'])) ? $data['body']['datenaiss'] : ''; ?>" id="datenaiss" name="datenaiss" placeholder="999/99/9999" />
                            <span class="invalid-feedback"><?= $data['body_err']['datenaiss_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-md-5 m-auto form-group row my-3">
                    <button class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>