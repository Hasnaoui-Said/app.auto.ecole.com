<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<style>
    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        text-decoration: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
</style>
<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <!-- page profil view -->
    <div class="container emp-profile">
        <form action="<?= URLROOT  ?>/profile" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="">
                        <div class="profile-img">
                            <img class="img_preview rounded" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($data['user']['image']); ?>" alt="" />
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input class="img_input <?= (!empty($data['body_err']['img_err'])) ? 'is-invalid' : ''; ?>" accept="image/png, image/jpe, image/jpg, image/jpeg" id="img" name="img" type="file">
                                <span class="invalid-feedback"><?= $data['body_err']['img_err']; ?></span>
                            </div>
                        </div>

                        <div class="row col-12 m-auto">
                            <a title="Supprimer mon profile" href="<?= URLROOT  ?>/profile/delete" class="btn btn-sm bg-white rounded border border-danger text-danger col-6 m-auto">Supprimer</a>
                        </div>
                    </div>
                    <div class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="profile-head">
                        <h5>
                            <?php echo $data['user']['name']; ?>
                        </h5>
                        <h6>
                            <?php echo $data['user']['role']; ?>
                        </h6>
                        <p class="proile-rating">Resultas examen : <span>null</span></p>
                        <p class="proile-rating">Status : <span class="bg-info  mx-3 px-2 rounded border">Active</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-12 my-3">
                        <input type="submit" class="profile-edit-btn" value="Sanvgarder" />
                    </div>
                    <div class="col-12">
                        <a href="<?= URLROOT ?>/profile" class="btn btn-primary profile-edit-btn text-white">Annuler</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>#</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nom</label>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <?php echo $data['user']['nom']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Prénom</label>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <?php echo $data['user']['prenom']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p> <?php echo $data['user']['email']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>+212 ....</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Role</label>
                                </div>
                                <div class="col-md-6">
                                    <p> <?php echo $data['user']['role']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- END page-header -->

<!-- BEGIN row -->

<!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>