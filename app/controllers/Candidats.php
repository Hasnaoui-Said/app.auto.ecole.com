<?php
class Candidats extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->candidatModel = $this->model('Candidat');
    $this->permisModel = $this->model('Permis');
    $this->userModel = $this->model('User');
    $this->typeFormationModel = $this->model('TypeFormation');
    $this->payiementModel = $this->model('Payiement');
    $this->adminModel = $this->model('Admin');
    $this->secretariatModel  = $this->model('Secretariat');
  }
  public function index()
  {
    // Get data candidats
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $limit = $_POST['row-nbr'];
      $candidats = $this->candidatModel->getAllCandidats($limit);
    } else {
      $candidats = $this->candidatModel->getAllCandidats();
    }
    $data = [
      'title' => 'Candidats',
      'menu' => 'candidats',
      'sub-menu' => 'candidats',
      'user' => $this->userConnected(),
      'candidats' => $candidats,
      'search' => ''
    ];
    $this->view('candidat/index', $data);
  }
  public function search()
  {
    // Get data users
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $search = $_POST['search'];
      $candidats = $this->candidatModel->search($search);
    } else {
      $candidats = $this->candidatModel->getAllCandidats();
    }
    $data = [
      'title' => 'Candidats',
      'menu' => 'candidats',
      'sub-menu' => 'candidats',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'candidats' => $candidats,
      'search' => $_POST['search']
    ];
    $this->view('candidat/index', $data);
  }
  public function add()
  {
    // get data categorie permis
    $permis = $this->permisModel->getPermis();
    // get data type formation
    $typeFormations = $this->typeFormationModel->getTypeFormations();
    // init body
    $body = array(
      'password' => 123456,
      'username' => '',
      'email' => '',
      'nom' => '',
      'prenom' => '',
      'cin' => '',
      'phone' => '',
      'sexe' => '',
      'dateNaiss' => '',
      'lieuNais' => '',
      'ville' => '',
      'adresse' => '',
      'prix' => '',
      'reste' => '',
      'dateDebutTher' => '',
      'nbrHeurThe' => '',
      'dateDebutPra' => '',
      'nbrHeurPra' => '',
      'categorie' => '',
      'typeFormation' => '',
      'numSite' => '',
      'numContrat' => '',
      'dateContrat' => '',
      'dateExamen1' => '',
      'dateExamen2' => '',
      'img' => '',
      'prenomAr' => '',
      'nomAr' => '',
      'lieuNaissAr' => '',
      'adresse_ar' => '',
    );
    $body_err = array(
      'username_err' => '',
      'email_err' => '',
      'nom_err' => '',
      'prenom_err' => '',
      'cin_err' => '',
      'phone_err' => '',
      'sexe_err' => '',
      'dateNaiss_err' => '',
      'lieuNais_err' => '',
      'ville_err' => '',
      'adresse_err' => '',
      'prix_err' => '',
      'reste_err' => '',
      'dateDebutTher_err' => '',
      'nbrHeurThe_err' => '',
      'dateDebutPra_err' => '',
      'nbrHeurPra_err' => '',
      'categorie_err' => '',
      'typeFormation_err' => '',
      'numSite_err' => '',
      'numContrat_err' => '',
      'dateContrat_err' => '',
      'dateExamen1_err' => '',
      'dateExamen2_err' => '',
      'img_err' => '',
      'prenomAr_err' => '',
      'nomAr_err' => '',
      'lieuNaissAr_err' => '',
      'adresse_ar_err' => '',
    );
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      extract($_POST);
      $body = array(
        'password' => 123456,
        'username' => $username,
        'email' => $email,
        'nom' => $nom,
        'prenom' => $prenom,
        'cin' => $cin,
        'phone' => $phone,
        'sexe' => $sexe,
        'dateNaiss' => $dateNaiss,
        'lieuNais' => $lieuNais,
        'ville' => $ville,
        'adresse' => $adresse,
        'prix' => $prix,
        'reste' => $reste,
        'dateDebutTher' => $dateDebutTher,
        'nbrHeurThe' => $nbrHeurThe,
        'dateDebutPra' => $dateDebutPra,
        'nbrHeurPra' => $nbrHeurPra,
        'categorie' => $categorie,
        'typeFormation' => $typeFormation,
        'numSite' => $numSite,
        'numContrat' => $numContrat,
        'dateContrat' => $dateContrat,
        'dateExamen1' => $dateExamen1,
        'dateExamen2' => $dateExamen2,
        'img' => '',
        'prenomAr' => $prenomAr,
        'nomAr' => $nomAr,
        'lieuNaissAr' => $lieuNaissAr,
        'adresse_ar' => $adresse_ar,
      );
      // Validate data
      setlocale(LC_TIME, ['MAR', 'mar', 'AR_ar']);
      $body['reste'] = $prix;
      // validate regex
      $regix_phone = "/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
      if (!preg_match("/^[\w\-]{6,16}$/", $username)) $body_err['username_err'] = 'le nom d\'utilsateur doit avoir au moins 6 caractére';
      if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) $body_err['email_err'] = 'Adresse email invalide';
      if (!preg_match("/^\w{2,16}$/", $nom)) $body_err['nom_err'] = 'Nom invalide';
      if (!preg_match("/^\w{2,16}$/", $prenom)) $body_err['prenom_err'] = 'Prénom invalide';
      if (!preg_match("/^\w{3,10}$/", $cin)) $body_err['cin_err'] = 'CIN invalide';
      if (!preg_match($regix_phone, $phone)) $body_err['phone_err'] = 'Numéro du télephone invalide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurPra)) $body_err['nbrHeurPra_err'] = 'Entrer un number valide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurThe)) $body_err['nbrHeurThe_err'] = 'Entrer un number valide';
      if (!preg_match("/^[01]$/", $sexe)) $body_err['sexe_err'] = 'Ce champ est obligatoire';
      if (!preg_match("/^\w+$/", $ville)) $body_err['ville_err'] = 'ville invalide';
      if (!preg_match("/^\w+$/", $adresse)) $body_err['adresse_err'] = 'adresse invalide';
      if (!preg_match("/^\w+$/", $lieuNais)) $body_err['lieuNais_err'] = 'lieu invalide';
      // if (!preg_match("/^[0-9]{0, 50}$/", $numSite)) $body_err['numSite_err'] = 'Numéro n\'existe pas';
      // if (!preg_match("/^[0-9]{0, 50}/", $numContrat)) $body_err['numContrat_err'] = 'Numéro du contrat invalide';
      if ($prix > 30000 || $prix < 1000) $body_err['prix_err'] = 'prix invalide';
      if ($reste > 30000 || $reste < 1000) $body_err['reste_err'] = 'reste invalide';
      if ($nbrHeurThe > 80 || $nbrHeurThe < 15) $body_err['nbrHeurThe_err'] = 'Numéro invalide';
      if ($nbrHeurPra > 80 || $nbrHeurPra < 15) $body_err['nbrHeurPra_err'] = 'Numéro invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateNaiss) + 14 * 365 * 24 *  3600);
      if ($x < 0) $body_err['datenaiss_err'] = ' Date naissance invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateDebutTher) + 24 * 3600);
      if ($x > 0) $body_err['dateDebutTher_err'] = ' Date invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateDebutPra) + 24 * 3600);
      if ($x > 0) $body_err['dateDebutPra_err'] = ' Date invalide';
      // validate image

      if (!empty($_FILES["img"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
          $image = $_FILES['img']['tmp_name'];
          $body['img'] = addslashes(file_get_contents($image));
        } else {
          $body_err['img_err'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
      }
      // Validate if not empty
      $isEmty = array('username', 'email', 'nom', 'prenom', 'cin', 'phone', 'lieuNais', 'prix', 'reste', 'nbrHeurThe', 'nbrHeurPra');
      if (empty($username)) $body_err['username_err'] = 'Champs obligatoire!';
      if (empty($email)) $body_err['email_err'] = 'Champs obligatoire!';
      if (empty($nom)) $body_err['nom_err'] = 'Champs obligatoire!';
      if (empty($prenom)) $body_err['prenom_err'] = 'Champs obligatoire!';
      if (empty($cin)) $body_err['cin_err'] = 'Champs obligatoire!';
      if (empty($phone)) $body_err['phone_err'] = 'Champs obligatoire!';
      if (empty($lieuNais)) $body_err['lieuNais_err'] = 'Champs obligatoire!';
      if (empty($prix)) $body_err['prix_err'] = 'Champs obligatoire!';
      if (empty($reste)) $body_err['reste_err'] = 'Champs obligatoire!';
      if (empty($nbrHeurPra)) $body_err['nbrHeurPra_err'] = 'Champs obligatoire!';
      if (empty($nbrHeurThe)) $body_err['nbrHeurThe_err'] = 'Champs obligatoire!';

      // Validate username
      $isExistUsername = $this->candidatModel->getCandidatByUsername($username);
      if (count($isExistUsername) > 0) $body_err['username_err'] = 'le nom d\'utilisateur deja existe!';
      // Validate Adresse Email
      $isExistEmail = $this->userModel->getUserByEmail($email);
      if (count($isExistEmail) > 0) $body_err['email_err'] = 'Adresse email deja existe!';
      $idPermis = array();
      foreach ($permis as $value) $idPermis[] = $value['id'];
      if (!in_array($categorie, $idPermis)) $body_err['categorie_err'] = 'champ obligatoire!';
      $idTypeFormations = array();
      foreach ($typeFormations as $value) $idTypeFormations[] = $value['id'];
      if (!in_array($typeFormation, $idTypeFormations)) $body_err['typeFormation_err'] = 'champ obligatoire!';
      // Make sure errors are empty
      if (
        empty($body_err['username_err']) && empty($body_err['email_err']) && empty($body_err['nom_err'])
        && empty($body_err['prenom_err']) && empty($body_err['cin_err']) && empty($body_err['phone_err'])
        && empty($body_err['lieuNais_err']) && empty($body_err['prix_err']) && empty($body_err['reste_err'])
        && empty($body_err['nbrHeurThe_err']) && empty($body_err['nbrHeurPra_err']) && empty($body_err['categorie_err'])
        && empty($body_err['datenaiss_err']) && empty($body_err['dateDebutTher_err']) && empty($body_err['dateDebutPra_err'])
        && empty($body_err['typeFormation_err']) && empty($body_err['sexe_err'])
        && empty($body_err['img_err'])
      ) {

        // Hash password
        $body['password'] =  password_hash($body['password'], PASSWORD_DEFAULT);
        // add user to database
        if ($this->userModel->addUser($body)) {
          // get User by username
          $user = $this->userModel->getUserByUsername($username);
          // add candidat to database
          $body['idUser'] = $user['id'];
          // add candidat
          if ($this->candidatModel->addCandidat($body)) {
            // get candidat by username
            $candidat = $this->candidatModel->getCandidatByUsername($username);
            $body['candidatId'] = $candidat['id'];
            //  add new payiement
            if ($this->payiementModel->addPayiement($body)) {
              flash('candidat_message', 'Candidat ajouté avec succès');
              redirect('candidats');
            } else {
              die('something went wrong');
            }
          } else {
            die('Something went wrong');
          }
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        // init data
        $data = [
          'title' => 'Candidats',
          'menu' => 'candidats',
          'sub-menu' => 'addCandidat',
          'action' => 'add',
          'user' => $this->userConnected(),
          'body' => $body,
          'body_err' => $body_err,
          'permis' => $permis,
          'typeFormations' => $typeFormations,
        ];
        $this->view('candidat/add', $data);
      }
    } else {
      $data = [
        'title' => 'Candidats',
        'menu' => 'candidats',
        'sub-menu' => 'addCandidat',
        'action' => 'add',
        'user' => $this->userConnected(),
        'body' => $body,
        'body_err' => $body_err,
        'permis' => $permis,
        'typeFormations' => $typeFormations,
      ];
      $this->view('candidat/add', $data);
    }
  }

  public function edit($id)
  {
    //  get candidat by id
    $candidat = $this->candidatModel->getCandidatById($id);
    // get data categorie permis
    $permis = $this->permisModel->getPermis();
    // get data type formation
    $typeFormations = $this->typeFormationModel->getTypeFormations();
    // init body
    $body = array(
      'candidatId' => $candidat['candidatId'],
      'userId' => $candidat['userId'],
      'username' => $candidat['username'],
      'email' => $candidat['email'],
      'nom' => $candidat['nom_fr'],
      'prenom' => $candidat['prenom_fr'],
      'cin' => $candidat['cin'],
      'phone' => $candidat['phone'],
      'sexe' => $candidat['sexe'],
      'dateNaiss' => $candidat['date_naiss'],
      'lieuNais' => $candidat['lieu_naiss'],
      'ville' => $candidat['ville'],
      'adresse' => $candidat['adresse'],
      'prix' => $candidat['total'],
      'reste' => $candidat['totalPayie'],
      'dateDebutTher' => $candidat['dateDebutThe'],
      'nbrHeurThe' => $candidat['nbr_heure_theorique'],
      'dateDebutPra' => $candidat['dateDebutPra'],
      'nbrHeurPra' => $candidat['nbr_heure_pratique'],
      'categorie' => $candidat['Categorie'],
      'typeFormation' => $candidat['typeFormation'],
      'numSite' => $candidat['n_siteMini'],
      'numContrat' => $candidat['numContrat'],
      'dateContrat' => $candidat['dateContrat'],
      // 'dateExamen1' => $candidat['dateExamen1'],
      // 'dateExamen2' => $candidat['dateExamen2'],
      'img' => $candidat['image'],
      'prenomAr' => $candidat['prenom_ar'],
      'nomAr' => $candidat['nom_ar'],
      'lieuNaissAr' => $candidat['lieu_naiss_Ar'],
      'adresse_ar' => $candidat['adresse_ar'],
    );
    $body_err = array(
      'username_err' => '',
      'email_err' => '',
      'nom_err' => '',
      'prenom_err' => '',
      'cin_err' => '',
      'phone_err' => '',
      'sexe_err' => '',
      'dateNaiss_err' => '',
      'lieuNais_err' => '',
      'ville_err' => '',
      'adresse_err' => '',
      'prix_err' => '',
      'reste_err' => '',
      'dateDebutTher_err' => '',
      'nbrHeurThe_err' => '',
      'dateDebutPra_err' => '',
      'nbrHeurPra_err' => '',
      'categorie_err' => '',
      'typeFormation_err' => '',
      'numSite_err' => '',
      'numContrat_err' => '',
      'dateContrat_err' => '',
      'dateExamen1_err' => '',
      'dateExamen2_err' => '',
      'img_err' => '',
      'prenomAr_err' => '',
      'nomAr_err' => '',
      'lieuNaissAr_err' => '',
      'adresse_ar_err' => '',
    );
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      extract($_POST);
      $body = array(
        'candidatId' => $candidat['candidatId'],
        'userId' => $candidat['userId'],
        'password' => 123456,
        'username' => $username,
        'email' => $email,
        'nom' => $nom,
        'prenom' => $prenom,
        'cin' => $cin,
        'phone' => $phone,
        'sexe' => $sexe,
        'dateNaiss' => $dateNaiss,
        'lieuNais' => $lieuNais,
        'ville' => $ville,
        'adresse' => $adresse,
        'prix' => $prix,
        'reste' => $reste,
        'dateDebutTher' => $dateDebutTher,
        'nbrHeurThe' => $nbrHeurThe,
        'dateDebutPra' => $dateDebutPra,
        'nbrHeurPra' => $nbrHeurPra,
        'categorie' => $categorie,
        'typeFormation' => $typeFormation,
        'numSite' => $numSite,
        'numContrat' => $numContrat,
        'dateContrat' => $dateContrat,
        'dateExamen1' => $dateExamen1,
        'dateExamen2' => $dateExamen2,
        'img' => '',
        'prenomAr' => $prenomAr,
        'nomAr' => $nomAr,
        'lieuNaissAr' => $lieuNaissAr,
        'adresse_ar' => $adresse_ar,
      );
      // Validate data
      setlocale(LC_TIME, ['MAR', 'mar', 'AR_ar']);
      // validate regex
      $regix_phone = "/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
      if (!preg_match($regix_phone, $phone)) $body_err['phone_err'] = 'Numéro du télephone invalide';
      if (!preg_match("/^[\w\-]{6,16}$/", $username)) $body_err['username_err'] = 'le nom d\'utilsateur doit avoir au moins 6 caractére';
      if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) $body_err['email_err'] = 'Adresse email invalide';
      if (!preg_match("/^[\w\s]{2,16}$/", $nom)) $body_err['nom_err'] = 'Nom invalide';
      if (!preg_match("/^[\w\s]{2,16}$/", $prenom)) $body_err['prenom_err'] = 'Prénom invalide';
      if (!preg_match("/^\w{3,10}$/", $cin)) $body_err['cin_err'] = 'CIN invalide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurPra)) $body_err['nbrHeurPra_err'] = 'Entrer un number valide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurThe)) $body_err['nbrHeurThe_err'] = 'Entrer un number valide';
      if (!preg_match("/^[01]$/", $sexe)) $body_err['sexe_err'] = 'Ce champ est obligatoire';
      if (!preg_match("/^[\w\s]+$/", $ville)) $body_err['ville_err'] = 'ville invalide';
      if (!preg_match("/^[\w\s]+$/", $adresse)) $body_err['adresse_err'] = 'adresse invalide';
      if (!preg_match("/^[\w\s]+$/", $lieuNais)) $body_err['lieuNais_err'] = 'lieu invalide';
      // if (!preg_match("/^[0-9]{0, 50}$/", $numSite)) $body_err['numSite_err'] = 'Numéro n\'existe pas';
      // if (!preg_match("/^[0-9]{0, 50}/", $numContrat)) $body_err['numContrat_err'] = 'Numéro du contrat invalide';
      if ($nbrHeurThe > 80 || $nbrHeurThe < 15) $body_err['nbrHeurThe_err'] = 'Numéro invalide';
      if ($nbrHeurPra > 80 || $nbrHeurPra < 15) $body_err['nbrHeurPra_err'] = 'Numéro invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateNaiss) + 14 * 365 * 24 *  3600);
      // validate image
      if (!empty($_FILES["img"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'jpe');
        if (in_array($fileType, $allowTypes)) {
          $image = $_FILES['img']['tmp_name'];
          $body['img'] = addslashes(file_get_contents($image));
        } else {
          $body_err['img_err'] = 'Sorry, only JPG, JPEG, PNG, & jpe files are allowed to upload.';
        }
      }
      // Validate if not empty
      if (empty($username)) $body_err['username_err'] = 'Champs obligatoire!';
      if (empty($email)) $body_err['email_err'] = 'Champs obligatoire!';
      if (empty($nom)) $body_err['nom_err'] = 'Champs obligatoire!';
      if (empty($prenom)) $body_err['prenom_err'] = 'Champs obligatoire!';
      if (empty($cin)) $body_err['cin_err'] = 'Champs obligatoire!';
      if (empty($phone)) $body_err['phone_err'] = 'Champs obligatoire!';
      if (empty($lieuNais)) $body_err['lieuNais_err'] = 'Champs obligatoire!';
      if (empty($nbrHeurPra)) $body_err['nbrHeurPra_err'] = 'Champs obligatoire!';
      if (empty($nbrHeurThe)) $body_err['nbrHeurThe_err'] = 'Champs obligatoire!';
      // Validate username different from current user 
      if ($this->userModel->findUserByUsernameDifferent($username, $body['userId'])) $body_err['username_err'] = 'Ce nom d\'utilsateur existe déjà';
      // Validate email different from current user
      if ($this->userModel->findUserByEmailDifferent($email, $body['userId'])) $body_err['email_err'] = 'Cette adresse email existe déjà';

      $idPermis = array();
      foreach ($permis as $value) $idPermis[] = $value['id'];
      if (!in_array($categorie, $idPermis)) $body_err['categorie_err'] = 'champ obligatoire!';
      $idTypeFormations = array();
      foreach ($typeFormations as $value) $idTypeFormations[] = $value['id'];
      if (!in_array($typeFormation, $idTypeFormations)) $body_err['typeFormation_err'] = 'champ obligatoire!';
      // Make sure errors are empty
      if (
        empty($body_err['username_err']) && empty($body_err['email_err']) && empty($body_err['nom_err'])
        && empty($body_err['prenom_err']) && empty($body_err['cin_err']) && empty($body_err['phone_err'])
        && empty($body_err['lieuNais_err']) && empty($body_err['nbrHeurThe_err']) && empty($body_err['nbrHeurPra_err'])
        && empty($body_err['categorie_err']) && empty($body_err['datenaiss_err'])
        && empty($body_err['typeFormation_err']) && empty($body_err['sexe_err'])
        && empty($body_err['img_err'])
      ) {
        // add user to database
        if ($this->userModel->updateUser($body)) {
          // update candidat
          if ($this->candidatModel->updateCandidat($body)) {
            flash('candidat_message', 'Candidat à été modifier avec succès');
            redirect('candidats');
          } else {
            die('Something went wrong');
          }
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        // init data
        $data = [
          'title' => 'Candidats',
          'menu' => 'candidats',
          'sub-menu' => 'addCandidat',
          'action' => 'edit',
          'user' => $this->userConnected(),
          'body' => $body,
          'body_err' => $body_err,
          'permis' => $permis,
          'typeFormations' => $typeFormations,
        ];
        $this->view('candidat/add', $data);
      }
    } else {
      $data = [
        'title' => 'Candidats',
        'menu' => 'candidats',
        'sub-menu' => 'addCandidat',
        'action' => 'edit',
        'user' => $this->userConnected(),
        'body' => $body,
        'body_err' => $body_err,
        'permis' => $permis,
        'typeFormations' => $typeFormations,
      ];
      // die;
      $this->view('candidat/add', $data);
    }
  }
  // desactivate candidat
  public function desactivate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->userModel->desactivateUser($id)) {
        flash('candidat_message', 'Candidat désactivé avec succès', 'alert-danger');
        redirect('candidats');
      } else {
        die('Something went wrong');
      }
    } else {
      die('Something went wrong');
    }
  }
  // activate candidat
  public function activate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->userModel->activateUser($id)) {
        flash('candidat_message', 'Candidat à été activé avec succès', 'alert-info');
        redirect('candidats');
      } else {
        die('Something went wrong');
      }
    } else {
      die('Something went wrong');
    }
  }
  // paye candidat
  public function paye($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // get candidat by id user
      $candidat = $this->candidatModel->getCandidatByIdUser($id);
      $payement = $this->payiementModel->getPayiementByCandidatId($candidat['id']);
      if ($payement['totalPayie'] == $payement['total']) {
        // get payiement by candidat id
        flash('candidat_message', 'Candidat à déjà payé', 'alert-info');
        redirect('candidats');
      } else {
        // die($payement['totalPayie'] < $payement['total']);
        redirect('payiements/add/' . $candidat['id'].'/'. 'F56766');
      }
    } else {
      throw new Exception('Something went wrong');
      die;
    }
  }
}
