<?php
class Profile extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->userModel = $this->model('User');
    $this->adminModel = $this->model('Admin');
    $this->candidatModel = $this->model('Candidat');
    $this->secretariatModel = $this->model('Secretariat');
    $this->moniteurModel = $this->model('Moniteur');
  }
  public function index()
  {
    $body = array(
      'img' => '',
    );
    $body_err = array(
      'img_err' => '',
    );

    // if isset post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // validate image
      if (!empty($_FILES["img"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'jpe');
        if (in_array($fileType, $allowTypes)) {
          $image = $_FILES['img']['tmp_name'];
          $body['img'] = addslashes(file_get_contents($image));
          // update image user
          if ($this->userModel->updateImageUser($body, $this->userConnected()['userId'])) {
            redirect('profile');
          } else {
            die('Something went wrong');
          }
        } else {
          $body_err['img_err'] = 'Sorry, only JPG, JPEG, PNG, & jpe files are allowed to upload.';
        }
      } else {
        $body_err['img_err'] = 'Please select an image file to upload.';
      }
    }
    $data = [
      'title' => 'Profile',
      'menu' => 'profile',
      'user' => $this->userConnected(),
      'body' => $body,
      'body_err' => $body_err,
    ];
    $this->view('profile/index', $data);
  }
  // supprimer profile
  public function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->userModel->deleteImageUser($this->userConnected()['userId'])) {
        // alert('success', 'Profile supprimé avec succès');
        flash('success', 'Profile supprimé avec succès'); 
        redirect('profile');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('profile');
    }
  }
}
