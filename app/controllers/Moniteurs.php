<?php
class Moniteurs extends Controller
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
      'title' => 'Moniteurs',
      'menu'=> 'moniteurs',
      'sub-menu'=> 'moniteurs',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('moniteurs/index', $data);
  }
  public function add()
  {
    // Get data users

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
