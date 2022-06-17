<!-- BEGIN #header -->
<div id="header" class="app-header">
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        <a href="" class="navbar-brand"><img class="me-2" src="<?php echo URLROOT; ?>/public/assets/img/logo/steering.png" alt=""></span> <b> Driving</b> School</a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- END navbar-header -->
    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
        <div class="navbar-item navbar-form">
            <form action="<?= URLROOT . '/' . $data['menu'] ?>/search" method="POST" name="search">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" value="<?= $data['search'] ?? '' ?>" placeholder="Chercher" />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img class="" width="100" height="100" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($data['user']['image']); ?>" alt="" />
                <span>
                    <span class="d-none d-md-inline"><?= $data['user']['name']; ?></span>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="profile" class="dropdown-item">Modifier le Profile</a>
                <!-- <a href="javascript:;" class="dropdown-item d-flex align-items-center">
                    Seance de formations
                    <span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
                </a> -->
                <a href="javascript:;" class="dropdown-item">Paramétres</a>
                <div class="dropdown-divider"></div>
                <a href="<?= URLROOT ?>/users/logout" class="dropdown-item">Se Déconnecter</a>
            </div>
        </div>
    </div>
    <!-- END header-nav -->
</div>
<!-- END #header -->

<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow" style="background: url(<?php echo URLROOT; ?>/public/assets/img/user/ecole.jpg);"></div>
                    <div class="menu-profile-image">
                        <img class="rounded" width="100" height="100" src="data:image/*;charset=utf8;base64,<?php echo base64_encode($data['user']['image']); ?>" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <?= $data['user']['name'] ?>
                            </div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small>Role :
                            <strong><?= $data['user']['role'] ?></strong>
                        </small>
                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item pt-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Paramétres</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="profile" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                        <div class="menu-text">Modifier le profile</div>
                    </a>
                </div>
                <!-- <div class="menu-item pb-5px">
                        <a href="javascript:;" class="menu-link">
                            <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
                            <div class="menu-text"> Logout</div>
                        </a>
                    </div> -->
                <div class="menu-item pb-5px">
                    <a href="<?= URLROOT ?>/users/logout" class="menu-link">
                        <div class="menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                        <div class="menu-text"> Se déconnecter</div>
                    </a>
                </div>
                <div class="menu-divider m-0"></div>
            </div>
            <div class="menu-header" id="fullScreen">Navigation</div>
            <div class="menu-item <?= $data['menu'] == 'home' ? 'active' : '' ?>">
                <a href="<?= URLROOT ?>/home" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-house-laptop"></i>
                    </div>
                    <div class="menu-text">Home</div>
                </a>
            </div>
            <div class="menu-item has-sub <?= $data['menu'] == 'candidats' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="menu-text">Condidats</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item  <?= $data['sub-menu'] == 'candidats' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/candidats" class="menu-link">
                            <div class="menu-text">Tous les Candidats</div>
                        </a>
                    </div>
                    <div class="menu-item  <?= $data['sub-menu'] == 'addCandidat' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/candidats/add" class="menu-link">
                            <div class="menu-text">Ajouter</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub  <?= $data['menu'] == 'groups' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="menu-text">Groups</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item  <?= $data['sub-menu'] == 'groups' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/groups" class="menu-link">
                            <div class="menu-text">Tous les Groups</div>
                        </a>
                    </div>
                    <div class="menu-item  <?= $data['sub-menu'] == 'addGroup' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/groups/add" class="menu-link">
                            <div class="menu-text">Créer</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub  <?= $data['menu'] == 'moniteurs' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <strong>M</strong>
                    </div>
                    <div class="menu-text">Moniteurs</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item  <?= $data['sub-menu'] == 'moniteurs' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/moniteurs" class="menu-link">
                            <div class="menu-text">Tous les moniteurs</div>
                        </a>
                    </div>
                    <div class="menu-item  <?= $data['sub-menu'] == 'addMoniteur' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/moniteurs/add" class="menu-link">
                            <div class="menu-text">Ajouter</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub  <?= $data['menu'] == 'vehicules' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <div class="menu-text">Voitures</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item  <?= $data['sub-menu'] == 'vehicules' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/vehicules" class="menu-link">
                            <div class="menu-text">Toutes les véhicule</div>
                        </a>
                    </div>
                    <div class="menu-item  <?= $data['sub-menu'] == 'addVehicules' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/vehicules/add" class="menu-link">
                            <div class="menu-text">Nouveau</div>
                        </a>
                    </div>
                    <div class="menu-item  <?= $data['sub-menu'] == 'notifications' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/vehicules/notifications" class="menu-link">
                            <div class="menu-text">Notifications</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item  <?= $data['menu'] == 'resultats' ? 'active' : '' ?>">
                <a href="<?= URLROOT ?>/resultats" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="menu-text">Resultats</div>
                </a>
            </div>

            <div class="menu-item has-sub <?= $data['menu'] == 'payiements' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div class="menu-text">Payiements</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item <?= $data['sub-menu'] == 'payiements' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/payiements" class="menu-link">
                            <div class="menu-text">Tous les payiements</div>
                        </a>
                    </div>
                    <div class="menu-item <?= $data['sub-menu'] == 'addPayiement' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/payiements/add" class="menu-link">
                            <div class="menu-text">Ajouter</div>
                        </a>
                    </div>
                    <div class="menu-item <?= $data['sub-menu'] == 'history' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/payiements/history" class="menu-link">
                            <div class="menu-text">Historique des payiements</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub <?= $data['menu'] == 'seanceFormations' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Seance de Formation</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item <?= $data['menu'] == 'seanceFormations' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/seanceFormations" class="menu-link">
                            <div class="menu-text">Toutes les Seances</div>
                        </a>
                    </div>
                    <div class="menu-item <?= $data['menu'] == 'planifier' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/seanceFormations/planifier" class="menu-link">
                            <div class="menu-text">Planifier une Seance</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub <?= $data['menu'] == 'series' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Series</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item <?= $data['menu'] == 'series' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/series" class="menu-link">
                            <div class="menu-text">Toutes les Series</div>
                        </a>
                    </div>
                    <div class="menu-item <?= $data['menu'] == 'addSerie' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/series/add" class="menu-link">
                            <div class="menu-text">Ajouter</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub <?= $data['menu'] == 'questions' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="menu-text">Questions</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item <?= $data['menu'] == 'questions' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/questions" class="menu-link">
                            <div class="menu-text">Toutes les Questions</div>
                        </a>
                    </div>
                    <div class="menu-item <?= $data['menu'] == 'addQuestion' ? 'active' : '' ?>">
                        <a href="<?= URLROOT ?>/questions/add" class="menu-link">
                            <div class="menu-text">Ajouter</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item <?= $data['menu'] == 'ecole' ? 'active' : '' ?>">
                <a href="<?= URLROOT ?>/ecole" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="menu-text">Ecole</div>
                </a>
            </div>
            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<!-- END #sidebar -->
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop">
    <a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link">
    </a>
</div>
<!-- END #sidebar -->