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
    // Get data user connected
    $user = $this->userModel->getUserConnected();
    echo '<pre>';
    print_r($user);
    echo '</pre>';
    die;

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
