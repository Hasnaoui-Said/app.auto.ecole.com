<?php
class Groups extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->groupModel = $this->model('Group');
  }
  public function index()
  {
    // Get data groups
    $groups = $this->groupModel->getGroups();
    $candidats = $this->groupModel->getCandidats();
    $data = [
      'title' => 'Groups',
      'menu'=> 'groups',
      'sub-menu'=> 'Groups',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'groups'=> $groups,
      'candidatsGrp'=> $candidats,
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
