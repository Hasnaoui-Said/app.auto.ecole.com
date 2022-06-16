<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <h1 class="page-header">Ajouter Candidat</h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body panel p-4">
        <form class="form-horizontal text-capitalize" 
        action="<?= URLROOT ?>/candidats/<?= ($data['action'] == 'add') ? 'add' : 'edit/'. $data['body']['candidatId'] ?> " 
        method="POST"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="row ">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="username">User name <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['username'])) ? $data['body']['username'] : ''; ?>" type="text" id="username" name="username" placeholder="Username" />
                                <span class="invalid-feedback"><?= $data['body_err']['username_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="email">Email <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['email'])) ? $data['body']['email'] : ''; ?>" type="email" id="email" name="email" placeholder="E-mail" />
                                <span class="invalid-feedback"><?= $data['body_err']['email_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="nom">Nom <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['nom_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['nom'])) ? $data['body']['nom'] : ''; ?>" type="text" id="nom" name="nom" placeholder="Nom" />
                                <span class="invalid-feedback"><?= $data['body_err']['nom_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="prenom">Prénom <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['prenom_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['prenom'])) ? $data['body']['prenom'] : ''; ?>" type="text" id="prenom" name="prenom" placeholder="prenom" />
                                <span class="invalid-feedback"><?= $data['body_err']['prenom_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="cin"> N° CIN <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['cin_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['cin'])) ? $data['body']['cin'] : ''; ?>" type="text" id="cin" name="cin" placeholder="CIN" />
                                <span class="invalid-feedback"><?= $data['body_err']['cin_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="phone"> Télephone <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['phone'])) ? $data['body']['phone'] : ''; ?>" type="text" id="phone" name="phone" placeholder="Télephone" />
                                <span class="invalid-feedback"><?= $data['body_err']['phone_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-10 col-md-8 form-group row mb-0 m-auto">
                            <label class="col-lg-4 col-form-label form-label" for="sexe">sexe <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <select class="form-select form-control <?= (!empty($data['body_err']['sexe_err'])) ? 'is-invalid' : ''; ?>" name="sexe">
                                    <optgroup label="Sexe">
                                        <option value="1" <?= (!empty($data['body']['sexe']) && $data['body']['sexe'] == 1) ? 'selected' : ''; ?>> Homme </option>
                                        <option value="0" <?= (!empty($data['body']['sexe']) && $data['body']['sexe'] == 0) ? 'selected' : ''; ?>> Femme </option>
                                    </optgroup>
                                </select>
                                <span class="invalid-feedback"><?= $data['body_err']['sexe_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-5" for="dateNaiss">Date naissance <sup>*</sup>: </label>
                            <div class="col-lg-7">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['dateNaiss_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['dateNaiss'])) ? $data['body']['dateNaiss'] : ''; ?>" id="dateNaiss" name="dateNaiss" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateNaiss_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-5 col-form-label form-label" for="lieuNais"> lieu naissance <sup>*</sup>:</label>
                            <div class="col-lg-7">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['lieuNais_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['lieuNais'])) ? $data['body']['lieuNais'] : ''; ?>" type="text" id="lieuNais" name="lieuNais" placeholder="Lieu naissance" />
                                <span class="invalid-feedback"><?= $data['body_err']['lieuNais_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="ville"> ville <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['ville_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['ville'])) ? $data['body']['ville'] : ''; ?>" type="text" id="ville" name="ville" />
                                <span class="invalid-feedback"><?= $data['body_err']['ville_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="adresse"> adresse <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control form-control-sm" rows="1" id="adresse" name="adresse" placeholder="Adresse ... "></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                    </div>
                    <div class="row <?= ($data['action'] == 'edit') ? 'd-none' : '' ?>">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="prix"> Prix (DHS) <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['prix_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['prix'])) ? $data['body']['prix'] : ''; ?>" type="number" min="0" max="20000" id="prix" name="prix" placeholder="Prix" />
                                <span class="invalid-feedback"><?= $data['body_err']['prix_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-4 col-form-label form-label" for="reste"> Reste(DHS) <sup>*</sup>:</label>
                            <div class="col-lg-8">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['reste_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['reste'])) ? $data['body']['reste'] : ''; ?>" type="number" min="0" max="20000" id="reste" name="reste" placeholder="Reste" />
                                <span class="invalid-feedback"><?= $data['body_err']['reste_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row <?= ($data['action'] == 'edit') ? 'd-none' : '' ?>">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6 text-capitalize" for="dateDebutTher">date debut théorique:</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['dateDebutTher_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['dateDebutTher'])) ? $data['body']['dateDebutTher'] : ''; ?>" name="dateDebutTher" id="dateDebutTher" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateDebutTher_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6" for="dateDebutPra">date debut pratique</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['dateDebutPra_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['dateDebutPra'])) ? $data['body']['dateDebutPra'] : ''; ?>" name="dateDebutPra" id="dateDebutPra" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateDebutPra_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-6 col-form-label form-label" for="nbrHeurThe"> Nombre d'heure théorique <sup>*</sup>:</label>
                            <div class="col-lg-6">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['nbrHeurThe_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['nbrHeurThe'])) ? $data['body']['nbrHeurThe'] : ''; ?>" type="number" min="10" max="60" id="nbrHeurThe" name="nbrHeurThe" placeholder="30" />
                                <span class="invalid-feedback"><?= $data['body_err']['nbrHeurThe_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-6 col-form-label form-label" for="nbrHeurPra"> nombre pratique <sup>*</sup> :</label>
                            <div class="col-lg-6">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['nbrHeurPra_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['nbrHeurPra'])) ? $data['body']['nbrHeurPra'] : ''; ?>" type="number" min="10" max="60" id="nbrHeurPra" name="nbrHeurPra" placeholder="20" />
                                <span class="invalid-feedback"><?= $data['body_err']['nbrHeurPra_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6" for="categorie">catégorie de permis <sup>*</sup>:</label>
                            <div class="col-lg-6">
                                <select class="form-select form-control <?= (!empty($data['body_err']['categorie_err'])) ? 'is-invalid' : ''; ?>" name="categorie">
                                    <?php foreach ($data['permis'] as $cat) : ?>
                                        <option value="<?= $cat['id'] ?>" <?= (!empty($data['body']['categorie']) && $cat['id'] == $data['body']['categorie']) ? 'selected' : ''; ?>>
                                            <?= $cat['id'] . ' - ' . $cat['Categorie'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <span class="invalid-feedback"><?= $data['body_err']['categorie_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6" for="typeFormation">Type de formation <sup>*</sup>:</label>
                            <div class="col-lg-6">
                                <select class="form-select form-control <?= (!empty($data['body_err']['typeFormation_err'])) ? 'is-invalid' : ''; ?>" name="typeFormation">
                                    <option></option>
                                    <?php foreach ($data['typeFormations'] as $typeFr) : ?>
                                        <option value="<?= $typeFr['id'] ?>" <?= (!empty($data['body']['typeFormation']) && $data['body']['typeFormation'] == $typeFr['id']) ? 'selected' : ''; ?>>
                                            <?= $typeFr['id'] . ' - ' . $typeFr['type'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <span class="invalid-feedback"><?= $data['body_err']['typeFormation_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row m-auto">
                        <div class="col-xs-12 col-md-8 form-group row mb-3 m-auto">
                            <label class="col-lg-6 col-form-label form-label" for="numSite"> N° (site ministére) <sup>*</sup> :</label>
                            <div class="col-lg-6">
                                <input class="form-control-sm form-control <?= (!empty($data['body_err']['numSite_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['numSite'])) ? $data['body']['numSite'] : ''; ?>" type="text" min="0" id="numSite" name="numSite" placeholder="" />
                                <span class="invalid-feedback"><?= $data['body_err']['numSite_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6" for="numContrat">N° Contrat : </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control-sm form-control <?= (!empty($data['body_err']['numContrat_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['numContrat'])) ? $data['body']['numContrat'] : ''; ?>" placeholder="N° Contrat" name="numContrat" />
                                <span class="invalid-feedback"><?= $data['body_err']['numContrat_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-6 col-form-label form-label" for="dateContrat"> Date Contrat <sup>*</sup>:</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['dateContrat_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['dateContrat'])) ? $data['body']['dateContrat'] : ''; ?>" name="dateContrat" id="dateContrat" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateContrat_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row text-nowrap">
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="form-label col-form-label col-lg-6" for="dateExamen1">Date examen 1:</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control-sm form-control <?= (!empty($data['body_err']['dateExamen1_err'])) ? 'is-invalid' : ''; ?>" value="<?= (!empty($data['body']['dateExamen1'])) ? $data['body']['dateExamen1'] : ''; ?>" id="dateExamen1" name="dateExamen1" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateExamen1_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 form-group row mb-3">
                            <label class="col-lg-6 col-form-label form-label" for="dateExamen2"> Date examen 2:</label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control-sm form-control" id="dateExamen2" name="dateExamen2" placeholder="999/99/9999" />
                                <span class="invalid-feedback"><?= $data['body_err']['dateExamen2_err']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="col-xs-12 form-group row mb-3">
                        <div class="col-4">
                            <img class="form-label-sm form-label w-100 img_preview"
                            src="data:image/*;charset=utf8;base64,<?php echo base64_encode($data['body']['img']); ?>"
                            alt="" width="100" height="100">
                        </div>
                        <div class="col-8 text-center">
                            <label for="img" class="form-label-sm form-label">Selectionne une image</label>
                            <input class="form-control form-control-sm img_input <?= (!empty($data['body_err']['img_err'])) ? 'is-invalid' : ''; ?>"
                             multiple accept="image/png, image/jpe, image/jpg, image/jpeg"  id="img" name="img" type="file">
                            <span class="invalid-feedback"><?= $data['body_err']['img_err']; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="form-group row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" type="text" id="prenomAr" name="prenomAr" />
                            </div>
                            <label class="col-lg-4 col-form-label form-label text-end" for="prenomAr"><sup>*</sup> :الاسم الشخص</label>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" type="text" id="nomAr" name="nomAr" />
                            </div>
                            <label class="col-lg-4 col-form-label form-label text-end" for="nomAr"><sup>*</sup> :الاسم العائلي</label>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control form-control-sm" type="text" id="lieuNaissAr" name="lieuNaissAr" />
                            </div>
                            <label class="col-lg-4 col-form-label form-label text-end" for="lieuNaissAr"><sup>*</sup> :مكان الازدياد</label>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-lg-8">
                                <textarea class="form-control form-control-sm w-100" id="adresse_ar" name="adresse_ar" rows="4"></textarea>
                            </div>
                            <label class="col-lg-4 col-form-label form-label text-end" for="username"><sup>*</sup> :العنوان</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 m-auto my-3">
                            <button class="btn btn-sm" style="color: #00acac; border: #00acac 1.2px solid;"><?= ($data['action'] == 'edit') ? 'Modiffier' : 'Ajouter' ?></button>
                        </div>
                    </div>
                    <!-- <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="message">Message (20 chars min, 200 max) :</label>
                        <div class="col-lg-8">
                            <textarea class="form-control-sm" id="message" name="message" rows="4" data-parsley-minlength="20" data-parsley-maxlength="100" placeholder="Range from 20 - 200"></textarea>
                        </div>
                    </div> -->
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>