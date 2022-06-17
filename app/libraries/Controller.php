<?php
/*
   * Base Controller
   * Loads the models and views
   */
class Controller
{
  // Load model
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';

    // Instatiate model
    return new $model();
  }

  // Load view
  public function view($view, $data = [])
  {
    // Check for view file
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      // View does not exist
      die('View does not exist');
    }
  }
  // load user connected
  public function userConnected()
  {
    if (!isLoggedIn()) {
      redirect();
    }

    $user = $this->userModel->getUserConnected();
    // get user role connected
    $role = ucwords(strtolower($user['role']));

    if ($role == 'Admin') {
      // get admin data by id User
      $userConnected = $this->adminModel->getAdminByIdUser($user['id']);
    } else if ($role == 'Candidat') {
      // get candidat data by id User
      $userConnected = $this->candidatModel->getCandidatByIdUser($user['id']);
    } else if ($role == 'Secretariat') {
      // get Secretariat data by id User
      $userConnected = $this->secretariatModel->getSecretariatByIdUser($user['id']);
    } else if ($role == 'Moniteur') {
      // get moniteur data by id 
      $userConnected = $this->moniteurModel->getMoniteurByIdUser($user['id']);
    }
    return [
      'id' => 'id',
      'name' => $userConnected['prenom'] . ' ' . $userConnected['nom'],
      'email' => $user['email'],
      'role' => $role,
      'image' => $userConnected['image'],
    ];
  }
}
