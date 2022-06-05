<?php
class Home extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->userModel = $this->model('User');
  }
  public function index()
  {
    // Get data users
    // $users = $this->usersModel->getUsers();

    $data = [
      'title' => 'home',
      'menu'=> 'home',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ]
    ];
    $this->view('home/index', $data);
  }
}