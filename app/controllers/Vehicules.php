<?php
class Vehicules extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->voitureModel = $this->model('Vehicule');
  }
  public function index()
  {
    // Get data voitures
    $voitures = $this->voitureModel->getVehicules();

    $data = [
      'title' => 'Véhicules',
      'menu' => 'vehicules',
      'sub-menu' => 'vehicules',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'voitures' => $voitures,
    ];
    $this->view('voitures/index', $data);
  }
  public function search()
  {
    // Get data voitures
    $voitures = $this->voitureModel->search($_POST['search']);

    $data = [
      'title' => 'Véhicules',
      'menu' => 'vehicules',
      'sub-menu' => 'vehicules',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'voitures' => $voitures,
      'search' => $_POST['search']
    ];
    $this->view('voitures/index', $data);
  }
  public function add()
  {
    // Get data voitures
    $voitures = $this->voitureModel->getVehicules();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init data
      $body = [
        'marque' => trim($_POST['marque']),
        'modele' => trim($_POST['modele']),
        'matricule' => trim($_POST['matricule']),
        'date_vidange' => trim($_POST['date_vidange']),
        'date_assurance' => trim($_POST['date_assurance']),
        'date_visite' => trim($_POST['date_visite']),
      ];
      $body_err = [
        'marque_err' => '',
        'modele_err' => '',
        'matricule_err' => '',
        'date_vidange_err' => '',
        'date_assurance_err' => '',
        'date_visite_err' => '',
      ];
      // Validate data
      if (empty($body['marque'])) {
        $body_err['marque_err'] = 'Veuillez entrer une marque';
      }
      if (empty($body['modele'])) {
        $body_err['modele_err'] = 'Veuillez entrer un modèle';
      }
      if (empty($body['matricule'])) {
        $body_err['matricule_err'] = 'Veuillez entrer un matricule';
      }
      if (empty($body['date_vidange'])) {
        $body_err['date_vidange_err'] = 'Veuillez entrer une date de vidange';
      }
      if (empty($body['date_assurance'])) {
        $body_err['date_assurance_err'] = 'Veuillez entrer une date d\'assurance';
      }
      if (empty($body['date_visite'])) {
        $body_err['date_visite_err'] = 'Veuillez entrer une date de visite';
      }
      // Make sure no errors
      if (empty($body_err['marque_err']) && empty($body_err['modele_err']) && empty($body_err['matricule_err']) && empty($body_err['date_vidange_err']) && empty($body_err['date_assurance_err']) && empty($body_err['date_visite_err'])) {
        // Validated
        if ($this->voitureModel->addVehicule($body)) {
          flash('voiture_message', 'Véhicule ajouté avec succès');
          redirect('vehicules');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $data = [
          'title' => 'Ajouter un Véhicules',
          'menu' => 'vehicules',
          'action' => 'add',
          'sub-menu' => 'add',
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
          'body' => $body,
          'body_err' => $body_err,
        ];
        $this->view('voitures/add', $data);
      }
    } else {
      // Init data
      $body = [
        'marque' => '',
        'modele' => '',
        'matricule' => '',
        'date_vidange' => '',
        'date_assurance' => '',
        'date_visite' => '',
      ];
      $body_err = [
        'marque_err' => '',
        'modele_err' => '',
        'matricule_err' => '',
        'date_vidange_err' => '',
        'date_assurance_err' => '',
        'date_visite_err' => '',
      ];

      $data = [
        'title' => 'Ajouter une Véhicule',
        'menu' => 'vehicules',
        'action' => 'add',
        'sub-menu' => 'add',
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
        'body' => $body,
        'body_err' => $body_err,
      ];
      $this->view('voitures/add', $data);
    }
  }
  public function edit($id)
  {
    $voiture = $this->voitureModel->getVehiculeById($id);
    // die(var_dump($voiture));
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init data
      $body = [
        'id' => $id,
        'marque' => trim($_POST['marque']),
        'modele' => trim($_POST['modele']),
        'matricule' => trim($_POST['matricule']),
        'date_vidange' => trim($_POST['date_vidange']),
        'date_assurance' => trim($_POST['date_assurance']),
        'date_visite' => trim($_POST['date_visite']),
      ];
      $body_err = [
        'marque_err' => '',
        'modele_err' => '',
        'matricule_err' => '',
        'date_vidange_err' => '',
        'date_assurance_err' => '',
        'date_visite_err' => '',
      ];
      // Validate data
      if (empty($body['marque'])) {
        $body_err['marque_err'] = 'Veuillez entrer une marque';
      }
      if (empty($body['modele'])) {
        $body_err['modele_err'] = 'Veuillez entrer un modèle';
      }
      if (empty($body['matricule'])) {
        $body_err['matricule_err'] = 'Veuillez entrer un matricule';
      }
      if (empty($body['date_vidange'])) {
        $body_err['date_vidange_err'] = 'Veuillez entrer une date de vidange';
      }
      if (empty($body['date_assurance'])) {
        $body_err['date_assurance_err'] = 'Veuillez entrer une date d\'assurance';
      }
      if (empty($body['date_visite'])) {
        $body_err['date_visite_err'] = 'Veuillez entrer une date de visite';
      }
      // Make sure no errors
      if (empty($body_err['marque_err']) && empty($body_err['modele_err']) && empty($body_err['matricule_err']) && empty($body_err['date_vidange_err']) && empty($body_err['date_assurance_err']) && empty($body_err['date_visite_err'])) {
        // Validated
        if ($this->voitureModel->updateVehicule($body)) {
          flash('voiture_message', 'Véhicule mis à jour avec succès');
          redirect('vehicules');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $data = [
          'title' => 'Modifier un Véhicules',
          'menu' => 'vehicules',
          'action' => 'edit',
          'sub-menu' => 'edit',
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
          'body' => $body,
          'body_err' => $body_err,
        ];
        $this->view('voitures/add', $data);
      }
    } else {
      // Init data
      $body = [
        'id' => $id,
        'marque' => $voiture['marque'],
        'modele' => $voiture['model'],
        'matricule' => $voiture['matricule'],
        'date_vidange' => $voiture['vidange'],
        'date_assurance' => $voiture['assurance'],
        'date_visite' => $voiture['visiteTechnique'],
      ];
      $body_err = [
        'marque_err' => '',
        'modele_err' => '',
        'matricule_err' => '',
        'date_vidange_err' => '',
        'date_assurance_err' => '',
        'date_visite_err' => '',
      ];
      $data = [
        'title' => 'Modifier une Véhicule',
        'menu' => 'vehicules',
        'action' => 'edit',
        'sub-menu' => 'edit',
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
        'body' => $body,
        'body_err' => $body_err,
      ];
      $this->view('voitures/add', $data);
    }
  }
  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->voitureModel->deleteVehicule($id)) {
        flash('voiture_message', 'Véhicule supprimé avec succès');
        redirect('vehicules');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('vehicules');
    }
  }
  public function notifications()
  {

    $data = [
      'title' => 'notifications',
      'menu' => 'vehicules',
      'sub-menu' => 'notifications',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('voitures/notifications', $data);
  }
}
