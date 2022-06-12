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
      'menu'=> 'vehicules',
      'sub-menu'=> 'vehicules',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'voitures'=> $voitures,
    ];
    $this->view('voitures/index', $data);
  }
  public function search()
  {
    // Get data voitures
    $voitures = $this->voitureModel->search($_POST['search']);

    $data = [
      'title' => 'Véhicules',
      'menu'=> 'vehicules',
      'sub-menu'=> 'vehicules',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'voitures'=> $voitures,
      'search' => $_POST['search']
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
