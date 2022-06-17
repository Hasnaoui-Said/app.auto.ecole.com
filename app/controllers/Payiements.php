<?php
class Payiements extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->candidatModel = $this->model('Candidat');
    $this->userModel = $this->model('User');
    $this->adminModel = $this->model('Admin');
    $this->secretariatModel = $this->model('Secretariat');
    $this->moniteurModel = $this->model('Moniteur');
  }
  public function index()
  {
    // Get data users

    $data = [
      'title' => 'Payiements',
      'menu'=> 'payiements',
      'sub-menu'=> 'payiements',
      'user' => $this->userConnected(),
    ];
    $this->view('payiement/index', $data);
  }
  public function add()
  {
    // Get data users

    $data = [
      'title' => 'Ajouter Payiements',
      'menu'=> 'payiements',
      'sub-menu'=> 'add',
      'user' => $this->userConnected(),
    ];
    $this->view('payiement/add', $data);
  }
  public function history()
  {
    // Get data users

    $data = [
      'title' => 'Historiqes des Payiements',
      'menu'=> 'payiements',
      'sub-menu'=> 'history',
      'user' => $this->userConnected(),
    ];
    $this->view('payiement/history', $data);
  }
}
