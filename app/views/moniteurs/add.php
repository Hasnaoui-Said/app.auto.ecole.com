<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header">Ajouter un nouveau moniteur :</h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body panel p-4">
        <form class="form-horizontal text-capitalize" action="<?= URLROOT.'/candidats/add' ?>" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="username"> Nom d'utilisateur <sup> *</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['username_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['username'])) ? $data['body']['username'] : ''; ?>" 
                                type="text" id="username" name="username"/>
                                <span class="invalid-feedback"><?= $data['body_err']['username_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="email"> Adresse e-mail <sup> *</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['email_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['email'])) ? $data['body']['email'] : ''; ?>" 
                                type="text" id="email" name="email"/>
                                <span class="invalid-feedback"><?= $data['body_err']['email_err']; ?></span>
                            </div>
                        </div>
                        <div class="row"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="nom">Nom :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['nom_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['nom'])) ? $data['body']['nom'] : ''; ?>" 
                                type="text" id="nom" name="nom"/>
                                <span class="invalid-feedback"><?= $data['body_err']['nom_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="prenom">Prénom :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['prenom_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['prenom'])) ? $data['body']['prenom'] : ''; ?>" 
                                type="text" id="prenom" name="prenom"/>
                                <span class="invalid-feedback"><?= $data['body_err']['prenom_err']; ?></span>
                            </div>
                        </div>
                        <div class="row"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="num_cpa">Numéro CPA :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['num_cpa_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['num_cpa'])) ? $data['body']['num_cpa'] : ''; ?>" 
                                type="text" id="num_cpa" name="num_cpa"/>
                                <span class="invalid-feedback"><?= $data['body_err']['num_cpa_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="date_cpa">Date CPA :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['date_cpa_err'])) ? 'is-invalid' : ''; ?>" 
                                value="<?= (!empty($data['body']['date_cpa'])) ? $data['body']['date_cpa'] : ''; ?>" 
                                type="text" id="date_cpa" name="date_cpa"/>
                                <span class="invalid-feedback"><?= $data['body_err']['date_cpa_err']; ?></span>
                            </div>
                        </div>
                        <div class="row"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-4" for="typeMoniteur">catégorie <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <select class="form-select form-control <?= (!empty($data['body_err']['typeMoniteur_err'])) ? 'is-invalid' : ''; ?>" 
                                name="typeMoniteur">
                                    <option> option</option>
                                    <?php 
                                    // foreach($data['permis'] as $cat) :
                                        ?>
                                    <option value="">
                                        option
                                    </option>
                                    <?php 
                                    // endforeach ;
                                    ?>
                                </select>
                                <span class="invalid-feedback"><?= $data['body_err']['categorie_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group mb-3 m-auto">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm w-50" style="color: #00acac; border: #00acac 1.2px solid;">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>