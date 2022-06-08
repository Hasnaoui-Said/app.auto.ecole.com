<?php
class Candidats extends Controller
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
    $candidats = $this->candidatModel->getCandidats();
    $data = [
      'title' => 'Candidats',
      'menu'=> 'candidats',
      'sub-menu'=> 'candidats',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'candidats' => $candidats,
    ];
    $this->view('candidat/index', $data);
  }
  public function search()
  {
    // Get data users
    $candidats = $this->candidatModel->search($_POST['search']);
    $data = [
      'title' => 'Candidats',
      'menu'=> 'candidats',
      'sub-menu'=> 'candidats',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'candidats' => $candidats,
    ];
    $this->view('candidat/index', $data);
  }
  public function add()
  {
    // Get data users

    $data = [
      'title' => 'Candidats',
      'menu'=> 'candidats',
      'sub-menu'=> 'add',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('candidat/add', $data);
  }
}
