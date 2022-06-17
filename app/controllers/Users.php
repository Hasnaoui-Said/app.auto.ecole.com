<?php
class Users extends Controller
{
  public function __construct()
  {
    if (isLoggedIn()) {
      redirect('home');
    }
    $this->userModel = $this->model('User');
    $this->userModel = $this->model('User');
    $this->adminModel = $this->model('Admin');
    $this->candidatModel = $this->model('Candidat');
    $this->secretariatModel = $this->model('Secretariat');
    $this->moniteurModel = $this->model('Moniteur');
  }

  public function index()
  {
    $data = [
      'title' => 'login',
      'email' => $_COOKIE['user_email'] ?? '',
      'password' => $_COOKIE['user_password'] ?? '',
      'cookie' => $_COOKIE['remember_me'] ?? '',
      'email_err' => '',
      'password_err' => ''
    ];
    $this->view('users/login', $data);
  }
  public function login()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Init data
      $data = [
        'title' => 'Auto ecole | login',
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'remember_me' => isset($_POST['remember_me']) ? trim($_POST['remember_me']) : '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'ADresse e-mail obligatoire';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Champ obligatoire';
      }

      // Check for user/email
      if (!$this->userModel->findUserByEmail($data['email'])) {
        // User found
        $data['email_err'] = 'Nom d\'utilisateur incorrect';
      }

      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['password_err'])) {
        // Validated
        // Check and set logged in user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if (count($loggedInUser) > 0) {
          // create cookie
          $this->createUserCookie($data['email'], $data['password'], $data['remember_me']);
          // Create Session
          $this->createUserSession($loggedInUser);
          redirect('home');
        } else {
          $data['password_err'] = 'Mot de passe incorrect';
          $this->view('users/login', $data);
        }
      } else {
        // Load view with errors
        $this->view('users/login', $data);
      }
    } else {
      // Init data
      $data = [
        'title' => 'Auto ecole | Connexion',
        'email' => $_COOKIE['user_email'] ?? '',
        'password' => $_COOKIE['user_password'] ?? '',
        'cookie' => $_COOKIE['remember_me'] ?? '',
        'email_err' => '',
        'password_err' => '',
      ];
      // Load view
      $this->view('users/login', $data);
    }
  }

  public function createUserSession($user)
  {
    $_SESSION['user'] = array(
      'user_id' => $user['id'],
      'user_email' => $user['email'],
      'role' => $user['role'],
    );
  }
  //  create user cookie
  public function createUserCookie($email, $password, $remember_me = '')
  {
    $cookie_expire = time() + (60 * 60 * 24 * 7);
    if ($remember_me == 'on') {
      // create cookie
      setcookie('user_password', $password, $cookie_expire,  '/', NULL, 0);
      setcookie('user_email', $email, $cookie_expire,  '/', NULL, 0);
      setcookie('remember_me', 'on', $cookie_expire, '/', NULL, 0);
    } else {
      // destroy user cookie
      setcookie('user_password', '', $cookie_expire, '/', NULL, 0);
      setcookie('user_email', '', $cookie_expire, '/', NULL, 0);
      setcookie('remember_me', '', $cookie_expire, '/', NULL, 0);
    }
  }
  public function logout()
  {
    unset($_SESSION['user']);
    session_destroy();
    redirect('');
  }
}