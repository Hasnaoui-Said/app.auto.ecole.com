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
    <div class="panel-body">
        <form class="form-horizontal" data-parsley-validate="true" name="demo-form">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="fullname">Full Name * :</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Required" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="email">Email * :</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="website">Website :</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="url" id="website" name="website" data-parsley-type="url" placeholder="url" />
                        </div>
                    </div>
                    <!-- <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="message">Message (20 chars min, 200 max) :</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="message" name="message" rows="4" data-parsley-minlength="20" data-parsley-maxlength="100" placeholder="Range from 20 - 200"></textarea>
                        </div>
                    </div> -->
                    <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="message">Digits :</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="digits" name="digits" data-parsley-type="digits" placeholder="Digits" />
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-lg-4 col-form-label form-label" for="message">Number :</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="number" name="number" data-parsley-type="number" placeholder="Number" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-form-label col-lg-4">SSN</label>
                        <div class="col-lg-8">
                            <input type="date" class="form-control" id="masked-input-ssn" placeholder="999/99/9999" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-5">
                    hello
                </div>
            </div>
        </form>
    </div>
    <!-- END panel-body -->
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>