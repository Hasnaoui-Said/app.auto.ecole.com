<?php
class Vehicules extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->candidatModel = $this->model('Candidat');
  }
  public function index()
  {
    // Get data users

    $data = [
      'title' => 'Véhicules',
      'menu'=> 'vehicules',
      'sub-menu'=> 'vehicules',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('voitures/index', $data);
  }
  public function add()
  {
    // Get data users

    $data = [
      'title' => 'Ajouter Véhicules',
      'menu'=> 'vehicules',
      'sub-menu'=> 'add',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('voitures/add', $data);
  }
  public function notifications()
  {
    // Get data users

    $data = [
      'title' => 'notifications',
      'menu'=> 'vehicules',
      'sub-menu'=> 'notifications',
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
