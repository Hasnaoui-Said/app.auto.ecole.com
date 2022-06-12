<?php
class Moniteurs extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->moniteurModel = $this->model('Moniteur');
  }
  public function index()
  {
    // Get data moniteur
    $moniteurs = $this->moniteurModel->getMoniteurs();

    $data = [
      'title' => 'Moniteurs',
      'menu'=> 'moniteurs',
      'sub-menu'=> 'moniteurs',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'moniteurs'=> $moniteurs,
    ];
    $this->view('moniteurs/index', $data);
  }
  public function search()
  {
    // Get data moniteur
    $moniteurs = $this->moniteurModel->search($_POST['search']);

    $data = [
      'title' => 'Moniteurs',
      'menu'=> 'moniteurs',
      'sub-menu'=> 'moniteurs',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'moniteurs'=> $moniteurs,
      'search' => $_POST['search']
    ];
    $this->view('moniteurs/index', $data);
  }
  public function add()
  {
    // Get data Moniteurs

    $data = [
      'title' => 'Moniteurs',
      'menu'=> 'moniteurs',
      'sub-menu'=> 'add',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('moniteurs/add', $data);
  }
}
