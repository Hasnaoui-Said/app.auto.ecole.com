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
  }
  public function index()
  {
    // Get data moniteur
    $moniteurs = $this->moniteurModel->getMoniteurs();

    $data = [
      'title' => 'Moniteurs',
      'menu' => 'moniteurs',
      'sub-menu' => 'moniteurs',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'moniteurs' => $moniteurs,
    ];
    $this->view('moniteurs/index', $data);
  }
  public function search()
  {
    // Get data moniteur
    $moniteurs = $this->moniteurModel->search($_POST['search']);

    $data = [
      'title' => 'Moniteurs',
      'menu' => 'moniteurs',
      'sub-menu' => 'moniteurs',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'moniteurs' => $moniteurs,
      'search' => $_POST['search']
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
      // Make sure no errors
      if (empty($body_err['nom_err']) && empty($body_err['prenom_err']) && empty($body_err['username_err']) && empty($body_err['email_err']) && empty($body_err['num_cpa_err']) && empty($body_err['date_cpa_err']) && empty($body_err['typeMoniteur_err'])) {
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
          }else{
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
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
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
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
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
        'moniteurId' => $moniteur['id'],
        'userId' => $user['id'],
        'email' => trim($_POST['email']),
        'num_cpa' => trim($_POST['num_cpa']),
        'date_cpa' => trim($_POST['date_cpa']),
        'typeMoniteur' => trim($_POST['typeMoniteur']),
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
      // Make sure no errors
      if (empty($body_err['nom_err']) && empty($body_err['prenom_err']) && empty($body_err['username_err']) && empty($body_err['email_err']) && empty($body_err['num_cpa_err']) && empty($body_err['date_cpa_err']) && empty($body_err['typeMoniteur_err'])) {
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
            flash('moniteur_message', 'Moniteur ajouté avec succès');
            redirect('moniteurs');
          }else{
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
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
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
      ];
      $data = [
        'title' => 'Modifier un moniteur :',
        'menu' => 'moniteurs',
        'action' => 'edit',
        'sub-menu' => 'addMoniteur',
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
        'typeMoniteurs' => $typeMoniteurs,
        'body' => $body,
        'body_err' => $body_err,
      ];

      $this->view('moniteurs/add', $data);
    }
  }
  // Delete moniteur
  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      // get moniteur by id
      $moniteur = $this->moniteurModel->getMoniteurById($id);
      if ($this->userModel->desactivateUser($moniteur['userId'])) {
        flash('moniteur_message', 'Moniteur supprimé avec succès');
        redirect('moniteurs');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('moniteurs');
    }
  }
}
