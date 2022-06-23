<?php
class Home extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->userModel = $this->model('User');
    $this->adminModel = $this->model('Admin');
    $this->candidatModel = $this->model('Candidat');
    $this->secretariatModel = $this->model('Secretariat');
    $this->moniteurModel = $this->model('Moniteur');
    $this->vehiculeModel = $this->model('Vehicule');
    $this->payiementModel = $this->model('Payiement');
  }
  public function index()
  {
    // Get data user connected
    $user = $this->userModel->getUserConnected();
    // get user role connected
    $role = ucwords(strtolower($user['role']));

    if ($role == 'Admin') {
      // get admin data by id User
      $userConnected = $this->adminModel->getAdminByIdUser($user['id']);
    } else
    if ($role == 'Candidat') {
      // get candidat data by id User
      $userConnected = $this->candidatModel->getCandidatByIdUser($user['id']);
    } else if ($role == 'Secretariat') {
      // get Secretariat data by id User
      $userConnected = $this->secretariatModel->getSecretariatByIdUser($user['id']);
    } else if ($role == 'Moniteur') {
      // get moniteur data by id 
      $userConnected = $this->moniteurModel->getMoniteurByIdUser($user['id']);
    }
    // get count candidats
    $countCandidats = $this->candidatModel->getCountCandidats();
    // get count moniteurs
    $countMoniteurs = $this->moniteurModel->getCountMoniteurs();
    // get count vehicules
    $countVehicules = $this->vehiculeModel->getCountVehicules();
    // get total payiements
    $totalPayements =     $this->payiementModel->getTotalPayiements();
    $data = [
      'title' => 'home',
      'menu' => 'home',
      'user' => $this->userConnected(),
      'countCandidats' => $countCandidats,
      'countMoniteurs' => $countMoniteurs,
      'countVehicules' => $countVehicules,
      'totalPayements' => $totalPayements,
    ];
    $this->view('home/index', $data);
  }
}
