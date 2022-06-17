<?php
class Profile extends Controller
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
      'title' => 'Profile',
      'menu'=> 'profile',
      'user' => $this->userConnected(),
    ];
    $this->view('profile/index', $data);
  }
  
}