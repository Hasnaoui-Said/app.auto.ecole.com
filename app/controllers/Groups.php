<?php
class Groups extends Controller
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
      'title' => 'Groups',
      'menu'=> 'groups',
      'sub-menu'=> 'Groups',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('groups/index', $data);
  }
  public function add()
  {
    // Get data users

    $data = [
      'title' => 'Groups',
      'menu'=> 'groups',
      'sub-menu'=> 'add',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('groups/add', $data);
  }
}
