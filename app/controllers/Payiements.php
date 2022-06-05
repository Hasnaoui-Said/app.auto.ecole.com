<?php
class Payiements extends Controller
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
      'title' => 'Payiements',
      'menu'=> 'payiements',
      'sub-menu'=> 'payiements',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
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
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
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
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('payiement/history', $data);
  }
}
