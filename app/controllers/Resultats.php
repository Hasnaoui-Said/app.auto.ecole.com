<?php
class Resultats extends Controller
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
    // Get data users

    $data = [
      'title' => 'Resultats',
      'menu'=> 'resultats',
      'user' => $this->userConnected(),
    ];
    $this->view('resultats/index', $data);
  }
  
}
