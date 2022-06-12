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
  }
  public function index()
  {
    // Get data candidats
    $candidats = $this->candidatModel->getCandidats();
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
      'search' => ''
    ];
    $this->view('candidat/index', $data);
  }
  public function search()
  {
    // Get data users
    $candidats = $this->candidatModel->search($_POST['search']);
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
    // Get data users
    $body = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      extract($_POST);
      $body = array(
        'username' => $username,
        'email' => $email,
        'nom' => $nom,
        'prenom' => $prenom,
        'cin' => $cin,
        'phone' => $phone,
        'datenaiss' => $datenaiss,
        'lieuNais' => $lieuNais,
        'ville' => $ville,
        'adresse' => $adresse,
        'prix' => $prix,
        'reste' => $reste,
        'dateDebutTher' => $dateDebutTher,
        'nbrHeurThe' => $nbrHeurThe,
        'dateDebutPra' => $dateDebutPra,
        'nbrHeurPra' => $nbrHeurPra,
        'numSite' => $numSite,
        'dateContrat' => $dateContrat,
        'numContrat' => $numContrat,
        'dateExamen1' => $dateExamen1,
        'dateExamen2' => $dateExamen2,
        'img' => $img,
        'prenomAr' => $prenomAr,
        'categorie' => $categorie,
        'nomAr' => $nomAr,
        'lieuNaissAr' => $lieuNaissAr,
        'adresse_ar' => $adresse_ar
      );
      $body_err = array(
        'username_err' => '',
        'email_err' => '',
        'nom_err' => '',
        'prenom_err' => '',
        'cin_err' => '',
        'phone_err' => '',
        'datenaiss_err' => '',
        'lieuNais_err' => '',
        'ville_err' => '',
        'adresse_err' => '',
        'prix_err' => '',
        'reste_err' => '',
        'dateDebutTher_err' => '',
        'nbrHeurThe_err' => '',
        'dateDebutPra_err' => '',
        'nbrHeurPra_err' => '',
        'numSite_err' => '',
        'numContrat' => '',
        'dateContrat_err' => '',
        'dateExamen1_err' => '',
        'categorie' => '',
        'dateExamen2_err' => '',
        'img_err' => '',
        'prenomAr_err' => '',
        'nomAr_err' => '',
        'lieuNaissAr_err' => '',
        'message_err' => ''
      );
      // Validate data
      setlocale(LC_TIME, ['MAR', 'mar', 'AR_ar']);
      // validate regex
      $body['reste'] = $prix;
      $regix_phone = "/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
      if (!preg_match("/^[\w\-]{6,16}$/", $username)) $body_err['username_err'] = 'le nom d\'utilsateur doit avoir au moins 6 caractére';
      if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) $body_err['email_err'] = 'Adresse email invalide';
      if (!preg_match("/^\w{2,16}$/", $nom)) $body_err['nom_err'] = 'Nom invalide';
      if (!preg_match("/^\w{2,16}$/", $prenom)) $body_err['prenom_err'] = 'Prénom invalide';
      if (!preg_match("/^\w{3,10}$/", $cin)) $body_err['cin_err'] = 'CIN invalide';
      if (!preg_match($regix_phone, $phone)) $body_err['phone_err'] = 'Numéro du télephone invalide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurPra)) $body_err['nbrHeurPra_err'] = 'Entrer un number valide';
      if (!preg_match("/^[1-9][0-9]$/", $nbrHeurThe)) $body_err['nbrHeurThe_err'] = 'Entrer un number valide';
      if (!preg_match("/^\w+$/", $ville)) $body_err['ville_err'] = 'ville invalide';
      if (!preg_match("/^\w+$/", $adresse)) $body_err['adresse_err'] = 'adresse invalide';
      if (!preg_match("/^\w+$/", $lieuNais)) $body_err['lieuNais_err'] = 'lieu invalide';
      // if (!preg_match("/^[0-9]{0, 50}$/", $numSite)) $body_err['numSite_err'] = 'Numéro n\'existe pas';
      // if (!preg_match("/^[0-9]{0, 50}/", $numContrat)) $body_err['numContrat_err'] = 'Numéro du contrat invalide';
      if ($prix > 30000 || $prix < 1000) $body_err['prix_err'] = 'prix invalide';
      if ($reste > 30000 || $reste < 1000) $body_err['reste_err'] = 'reste invalide';
      if ($nbrHeurThe > 80 || $nbrHeurThe < 15) $body_err['nbrHeurThe_err'] = 'Numéro invalide';
      if ($nbrHeurPra > 80 || $nbrHeurPra < 15) $body_err['nbrHeurPra_err'] = 'Numéro invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($datenaiss) + 14 * 365 * 24 *  3600);
      if ($x < 0) $body_err['datenaiss_err'] = ' Date naissance invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateDebutTher) + 24 * 3600);
      if ($x > 0) $body_err['dateDebutTher_err'] = ' Date invalide';
      $x = strtotime(Date("d-m-Y")) - (strtotime($dateDebutPra) + 24 * 3600);
      if ($x > 0) $body_err['dateDebutPra_err'] = ' Date invalide';
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
    }

    $data = [
      'title' => 'Candidats',
      'menu' => 'candidats',
      'sub-menu' => 'add',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'body' => $body,
      'body_err' => $body_err,
      'permis' => $permis,
    ];
    $this->view('candidat/add', $data);
  }
}
