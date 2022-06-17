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
    $data = [
      'title' => 'home',
      'menu' => 'home',
      'user' => $this->userConnected(),
      ];
    $this->view('home/index', $data);
  }
}
