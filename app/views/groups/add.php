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
        <form class="row form-horizontal text-capitalize" action="<?= URLROOT.'/candidats/add' ?>" method="POST">
            <div class="row m-auto">
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="ville"> Nom du group <sup>*</sup>:</label>
                    <div class="col-lg-8">
                        <input class="form-control-sm form-control <?= (!empty($data['body_err']['ville_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?= (!empty($data['body']['ville'])) ? $data['body']['ville'] : ''; ?>" 
                        type="text" id="ville" name="ville"/>
                        <span class="invalid-feedback"><?= $data['body_err']['ville_err']; ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="adresse"> Description du Group :</label>
                    <div class="col-lg-8">
                        <textarea class="form-control form-control-sm" rows="3" id="adresse" name="adresse" placeholder="Adresse ... "></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
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