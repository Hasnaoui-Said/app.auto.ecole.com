<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <!-- BEGIN page-header -->
    <?php
    flash('login_success');
    ?>
    <h1 class="page-header">Dashboard</h1>
    <!-- END page-header -->

    <!-- BEGIN row -->
    <div class="row">
        <!-- BEGIN col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-success">
                <div class="stats-icon"><i class="fa-solid fa-square-dollar">$</i></div>
                <div class="stats-info">
                    <h4>TOTALE PAYEMENTS</h4>
                    <p><?= $data['totalPayements']?> . 000 (DHS)</p>
                </div>
                <div class="stats-link">
                    <a href="<?= URLROOT?>/payiements">View Detail<i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
         <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-danger">
                <div class="stats-icon"><i class="fa fa-links">M</i></div>
                <div class="stats-info">
                    <h4>TOATALE DES MONITEURS</h4>
                    <p><?= $data['countMoniteurs']?></p>
                </div>
                <div class="stats-link">
                    <a href="<?= URLROOT?>/moniteurs">View Detail<i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>TOTALE DES CANDIDATS</h4>
                    <p><?= $data['countCandidats']?></p>
                </div>
                <div class="stats-link">
                    <a href="<?= URLROOT?>/candidats">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-warning">
                <div class="stats-icon"><i class="fa-solid fa-car"></i></div>
                <div class="stats-info">
                    <h4>TOTALE DES VEHICULES</h4>
                    <p><?= $data['countVehicules']?></p>
                </div>
                <div class="stats-link">
                    <a href="<?= URLROOT?>/vehicules">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- END col-3 -->
    </div>
    <!-- END row -->

</div>
<!-- END #content -->

<?php require APPROOT . '/views/inc/footer.php'; ?>