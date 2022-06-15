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
        <form class="row form-horizontal text-capitalize" action="<?= URLROOT  ?>/groups/<?= $data['action'] == 'add' ? 'add/' : 'edit/' . $data['body']['id'] ?>" method="POST">
            <div class="row m-auto">
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nomGroup"> Nom du group <sup>*</sup>:</label>
                    <div class="col-lg-8">
                        <input class="form-control-sm form-control <?= (!empty($data['body_err']['nomGroup_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['nomGroup'])) ? $data['body']['nomGroup'] : ''; ?>" type="text" id="nomGroup" name="nomGroup" />
                        <span class="invalid-feedback"><?= $data['body_err']['nomGroup_err']; ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="description"> Description du Group :</label>
                    <div class="col-lg-8">
                        <textarea class="form-control form-control-sm" rows="3" id="description" name="description" placeholder="description ... "></textarea>
                        <span class="invalid-feedback"><?= $data['body_err']['description_err']; ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nomGroup"> Ajouter des Candiddats <sup>*</sup>:</label>
                    <div class="col-lg-8">
                        <select name="candidats[]" class="multiple-select2 form-control" multiple>
                            <?php foreach ($data['allCandidats'] as $candidat) : ?>
                                <?php if ($candidat['Categorie'] == 'A1') : ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option selected value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'A'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'B'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'C'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'D'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'EB'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'EC'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php elseif ($candidat['Categorie'] == 'ED'): ?>
                                    <optgroup label="<?= $candidat['Categorie'] ?>">
                                        <option value="<?= $candidat['candidatId'] ?>"><?= $candidat['username'] ?></option>
                                    </optgroup>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?= $data['body_err']['candidats_err']; ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 m-auto form-group row mb-3">
                    <button class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;">
                        <?= $data['action'] == 'add' ? 'Ajouter' : 'modifier' ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->
</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>