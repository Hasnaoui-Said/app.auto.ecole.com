<?php
class Moniteurs extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->moniteurModel = $this->model('Moniteur');
    $this->userModel = $this->model('User');
    $this->typeMoniteurModel = $this->model('TypeMoniteur');
    $this->adminModel = $this->model('Admin');
    $this->candidatModel = $this->model('Candidat');
    $this->secretariatModel = $this->model('Secretariat');
  }
  public function index()
  {
    // Get data moniteur
    // if post request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $limit = $_POST['row-nbr'];
      $moniteurs = $this->moniteurModel->getAllMoniteurs($limit);
    } else {
      $moniteurs = $this->moniteurModel->getAllMoniteurs();
    }

    $data = [
      'title' => 'Moniteurs',
      'menu' => 'moniteurs',
      'sub-menu' => 'moniteurs',
      'user' => $this->userConnected(),
      'moniteurs' => $moniteurs,
      'limit' => $limit ?? 1,
    ];
    $this->view('moniteurs/index', $data);
  }
  public function search()
  {
    // Get data moniteur
    if (isset($_POST['search'])) {
      $search = $_POST['search'];
      $moniteurs = $this->moniteurModel->search($search);
    } else {
      $moniteurs = $this->moniteurModel->getAllMoniteurs();
    }
    $data = [
      'title' => 'Moniteurs',
      'menu' => 'moniteurs',
      'sub-menu' => 'moniteurs',
      'user' => $this->userConnected(),
      'moniteurs' => $moniteurs,
      'limit' => $limit ?? 10,
      'search' => $_POST['search'] ?? '',
    ];
    $this->view('moniteurs/index', $data);
  }
  public function add()
  {
    // Get data Moniteurs
    $moniteurs = $this->moniteurModel->getMoniteurs();
    // Get data TypeMoniteur
    $typeMoniteurs = $this->typeMoniteurModel->getTypeMoniteurs();
    // die(var_dump($typeMoniteurs));

    $body = [];
    $body_err = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init data
      $body = [
        'nom' => trim($_POST['nom']),
        'prenom' => trim($_POST['prenom']),
        'username' => trim($_POST['username']),
        'password' => 123456,
        'userId' => '',
        'email' => trim($_POST['email']),
        'num_cpa' => trim($_POST['num_cpa']),
        'date_cpa' => trim($_POST['date_cpa']),
        'typeMoniteur' => trim($_POST['typeMoniteur']),
        'phone' => trim($_POST['phone']),
      ];
      // die(var_dump($_POST));
      // Validate data
      $body_err = [
        'nom_err' => '',
        'prenom_err' => '',
        'username_err' => '',
        'email_err' => '',
        'num_cpa_err' => '',
        'date_cpa_err' => '',
        'typeMoniteur_err' => '',
      ];

      // validate regex
      $regix_phone = "/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
      if (!preg_match($regix_phone, $body['phone'])) $body_err['phone_err'] = 'Numéro du télephone invalide';
      // Validate nom
      if (empty($body['nom'])) {
        $body_err['nom_err'] = 'Ce champ est obligatoire';
      }
      // Validate prenom
      if (empty($body['prenom'])) {
        $body_err['prenom_err'] = 'Ce champ est obligatoire';
      }
      // Validate username
      if (empty($body['username'])) {
        $body_err['username_err'] = 'Ce champ est obligatoire';
      } else {
        if ($this->userModel->findUserByUsername($body['username'])) {
          $body_err['username_err'] = 'Ce nom d\'utilisateur est déjà utilisé';
        }
      }
      // Validate email
      if (empty($body['email'])) {
        $body_err['email_err'] = 'Ce champ est obligatoire';
      } else {
        if ($this->userModel->findUserByEmail($body['email'])) {
          $body_err['email_err'] = 'Cet adresse email est déjà utilisé';
        }
      }
      // Validate num_cpa
      if (empty($body['num_cpa'])) {
        $body_err['num_cpa_err'] = 'Ce champ est obligatoire';
      }
      // Validate date_cpa
      if (empty($body['date_cpa'])) {
        $body_err['date_cpa_err'] = 'Ce champ est obligatoire';
      }
      // Validate categorie moniteur
      if (empty($body['typeMoniteur'])) {
        $body_err['typeMoniteur_err'] = 'Ce champ est obligatoire';
      }
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
      // Make sure no errors
      if (
        empty($body_err['nom_err']) && empty($body_err['prenom_err']) && empty($body_err['username_err']) &&
        empty($body_err['email_err']) && empty($body_err['num_cpa_err']) && empty($body_err['date_cpa_err']) &&
        empty($body_err['typeMoniteur_err']) && empty($body_err['phone_err'])
      ) {
        // hash password
        $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
        // Validate data
        // add user to database
        if ($this->userModel->addUser($body)) {
          // get user by username
          $user = $this->userModel->getUserByUsername($body['username']);
          // init id user
          $body['userId'] = $user['id'];
          // add moniteur
          if ($this->moniteurModel->addMoniteur($body)) {
            flash('moniteur_message', 'Moniteur ajouté avec succès');
            redirect('moniteurs');
          } else {
            die('Something went wrong');
          }
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $data = [
          'title' => 'Ajouter un moniteur :',
          'menu' => 'moniteurs',
          'action' => 'add',
          'sub-menu' => 'add',
          'user' => $this->userConnected(),
          'moniteurs' => $moniteurs,
          'typeMoniteurs' => $typeMoniteurs,
          'body' => $body,
          'body_err' => $body_err,
        ];
        $this->view('moniteurs/add', $data);
      }
    } else {

      $data = [
        'title' => 'Ajouter un moniteur :',
        'menu' => 'moniteurs',
        'action' => 'add',
        'sub-menu' => 'addMoniteur',
        'user' => $this->userConnected(),
        'moniteurs' => $moniteurs,
        'typeMoniteurs' => $typeMoniteurs,
        'body' => $body,
        'body_err' => $body_err,
      ];

      $this->view('moniteurs/add', $data);
    }
  }
  public function edit($id)
  {
    // Get data TypeMoniteur
    $typeMoniteurs = $this->typeMoniteurModel->getTypeMoniteurs();
    // init data
    $moniteur = $this->moniteurModel->getMoniteurById($id);
    $user = $this->userModel->getUserById($moniteur['userId']);

    $body = [];
    $body_err = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init data
      extract($_POST);
      $body = [
        'nom' => trim($_POST['nom']),
        'prenom' => trim($_POST['prenom']),
        'username' => trim($_POST['username']),
        'password' => 123456,
        'moniteurId' => $moniteur['id'],
        'userId' => $user['id'],
        'email' => trim($_POST['email']),
        'num_cpa' => trim($_POST['num_cpa']),
        'date_cpa' => trim($_POST['date_cpa']),
        'typeMoniteur' => trim($_POST['typeMoniteur']),
        'phone' => trim($_POST['phone']),
        'img' => '',
        'phone' => '',
      ];
      // Validate data
      $body_err = [
        'nom_err' => '',
        'prenom_err' => '',
        'username_err' => '',
        'email_err' => '',
        'num_cpa_err' => '',
        'date_cpa_err' => '',
        'typeMoniteur_err' => '',
        'img_err' => '',
        'phone_err' => '',
      ];
      // init phone
      $body['phone'] = trim($_POST['phone']);
      // validate regex
      $regix_phone = "/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
      if (!preg_match($regix_phone, $phone)) $body_err['phone_err'] = 'Numéro du télephone invalide';
      // Validate nom
      if (empty($body['nom'])) {
        $body_err['nom_err'] = 'Ce champ est obligatoire';
      }
      // Validate prenom
      if (empty($body['prenom'])) {
        $body_err['prenom_err'] = 'Ce champ est obligatoire';
      }
      // Validate username
      if (empty($body['username'])) {
        $body_err['username_err'] = 'Ce champ est obligatoire';
      } else {
        if ($this->userModel->findUserByUsernameDifferent($body['username'], $body['userId'])) {
          $body_err['username_err'] = 'Ce nom d\'utilisateur est déjà utilisé';
        }
      }
      // Validate email
      if (empty($body['email'])) {
        $body_err['email_err'] = 'Ce champ est obligatoire';
      } else {
        if ($this->userModel->findUserByEmailDifferent($body['email'], $body['userId'])) {
          $body_err['email_err'] = 'Cet adresse email est déjà utilisé';
        }
      }

      // Validate num_cpa
      if (empty($body['num_cpa'])) {
        $body_err['num_cpa_err'] = 'Ce champ est obligatoire';
      }
      // Validate date_cpa
      if (empty($body['date_cpa'])) {
        $body_err['date_cpa_err'] = 'Ce champ est obligatoire';
      }
      // Validate categorie moniteur
      if (empty($body['typeMoniteur'])) {
        $body_err['typeMoniteur_err'] = 'Ce champ est obligatoire';
      }
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
      // Make sure no errors
      if (
        empty($body_err['nom_err']) && empty($body_err['prenom_err']) && empty($body_err['username_err']) &&
        empty($body_err['email_err']) && empty($body_err['num_cpa_err']) && empty($body_err['date_cpa_err']) &&
        empty($body_err['typeMoniteur_err']) && empty($body_err['img_err']) &&
        empty($body_err['phone_err'])
      ) {
        // hash password
        $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
        // Validate data
        // add user to database
        if ($this->userModel->UpdateUser($body)) {
          // get user by username
          $user = $this->userModel->getUserByUsername($body['username']);
          // init id user
          $body['userId'] = $user['id'];
          // add moniteur
          if ($this->moniteurModel->UpdateMoniteur($body)) {
            flash('moniteur_message', 'Moniteur a été modifier avec succès', 'alert-warning');
            redirect('moniteurs');
          } else {
            die('Something went wrong');
          }
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $data = [
          'title' => 'Ajouter un moniteur :',
          'menu' => 'moniteurs',
          'action' => 'edit',
          'sub-menu' => 'addMoniteur',
          'user' => $this->userConnected(),
          'typeMoniteurs' => $typeMoniteurs,
          'body' => $body,
          'body_err' => $body_err,
        ];
        $this->view('moniteurs/add', $data);
      }
    } else {
      $body = [
        'nom' => $moniteur['nom'],
        'prenom' => $moniteur['prenom'],
        'moniteurId' => $moniteur['id'],
        'userId' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'num_cpa' => $moniteur['num_cpa'],
        'date_cpa' => $moniteur['date_cpa'],
        'typeMoniteur' => $moniteur['typeMoniteurId'],
        'phone' => $moniteur['phone'],
        'img' => $user['image'],
      ];
      $data = [
        'title' => 'Modifier un moniteur :',
        'menu' => 'moniteurs',
        'action' => 'edit',
        'sub-menu' => 'addMoniteur',
        'user' => $this->userConnected(),
        'typeMoniteurs' => $typeMoniteurs,
        'body' => $body,
        'body_err' => $body_err,
      ];
      // die;
      $this->view('moniteurs/add', $data);
    }
  }
  // Delete moniteur
  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // get moniteur by id
      $moniteur = $this->moniteurModel->getMoniteurById($id);
      if ($this->moniteurModel->deleteMoniteur($moniteur['userId'])) {
        if ($this->userModel->deleteUser($moniteur['userId'])) {
          flash('moniteur_message', 'Moniteur supprimé avec succès', 'alert-danger');
          redirect('moniteurs');
        } else {
          die('Something went wrong');
        }
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('moniteurs');
    }
  }
  // desactivate moniteur
  public function desactivate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // get moniteur by id
      $moniteur = $this->moniteurModel->getMoniteurById($id);
      if ($this->userModel->desactivateUser($moniteur['userId'])) {
        flash('moniteur_message', 'Moniteur à été desactivé avec succès', 'alert-warning');
        redirect('moniteurs');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('moniteurs');
    }
  }
  // activate moniteur
  public function activate($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // get moniteur by id
      $moniteur = $this->moniteurModel->getMoniteurById($id);
      if ($this->userModel->activateUser($moniteur['userId'])) {
        flash('moniteur_message', 'Moniteur à été activé avec succès', 'alert-info');
        redirect('moniteurs');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('moniteurs');
    }
  }
}
