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
    // $posts = $this->usersModel->getPosts();

    $data = [
      'user' => 'userid'
    ];
    $this->view('home/index', $data);
  }
}
