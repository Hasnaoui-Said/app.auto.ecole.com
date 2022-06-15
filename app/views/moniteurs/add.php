<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header"><?= $data['title'] ?></h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body panel p-4">
        <form class="form-horizontal text-capitalize" action="<?= URLROOT  ?>/moniteurs/<?= $data['action'] == 'add' ? 'add/' : 'edit/' . $data['body']['moniteurId'] ?>" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="username"> Nom d'utilisateur <?= $data['action'] == 'add' ? 'add/' : 'edit/' . $data['body']['moniteurId'] ?>  <sup> *</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['username'])) ? $data['body']['username'] : ''; ?>" type="text" id="username" name="username" />
                                <span class="invalid-feedback"><?= $data['body_err']['username_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="email"> Adresse e-mail <sup> *</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['email'])) ? $data['body']['email'] : ''; ?>" type="text" id="email" name="email" />
                                <span class="invalid-feedback"><?= $data['body_err']['email_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="nom">Nom :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['nom_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['nom'])) ? $data['body']['nom'] : ''; ?>" type="text" id="nom" name="nom" />
                                <span class="invalid-feedback"><?= $data['body_err']['nom_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="prenom">Prénom :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['prenom_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['prenom'])) ? $data['body']['prenom'] : ''; ?>" type="text" id="prenom" name="prenom" />
                                <span class="invalid-feedback"><?= $data['body_err']['prenom_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="num_cpa">Numéro CPA :</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['num_cpa_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['num_cpa'])) ? $data['body']['num_cpa'] : ''; ?>" type="text" id="num_cpa" name="num_cpa" />
                                <span class="invalid-feedback"><?= $data['body_err']['num_cpa_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="date_cpa">Date CPA :</label>
                            <div class="col-lg-8">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['d ate_cpa_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['date_cpa'])) ? $data['body']['date_cpa'] : ''; ?>" id="date_cpa" name="date_cpa" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['date_cpa_err']; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-4" for="typeMoniteur">catégorie <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <select class="form-select form-control <?= (!empty($data['body_err']['typeMoniteur_err'])) ? 'is-invalid' : ''; ?>" name="typeMoniteur">
                                    <option></option>
                                    <?php foreach ($data['typeMoniteurs'] as $row) : ?>
                                        <option value="<?= $row['id'] ?>" <?php
                                                                            if (!empty($data['body']['typeMoniteur'])) {
                                                                                if ($data['body']['typeMoniteur'] == $row['id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>>
                                            <?= $row['id'] . ' - ' . $row['type']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="invalid-feedback"><?= $data['body_err']['typeMoniteur_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group mb-3 m-auto">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">
                                    <?= $data['action'] == 'add' ? 'Ajouter' : 'modifier' ?>
                                </button>
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