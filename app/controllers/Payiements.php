<?php
class Payiements extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->candidatModel = $this->model('Candidat');
    $this->userModel = $this->model('User');
    $this->adminModel = $this->model('Admin');
    $this->secretariatModel = $this->model('Secretariat');
    $this->moniteurModel = $this->model('Moniteur');
    $this->payiementModel = $this->model('Payiement');
  }
  public function index($payiementId = null, $body_err = ['prix' => ''])
  {
    // Get data data payiement
    // verifie si le candidat existe
    $payiements = $this->payiementModel->getPayiements();
    if ($payiementId) {
      $hystory = $this->payiementModel->getHistrory($payiementId);
      // get payiement by id
      $payiement = $this->payiementModel->getPayiementById($payiementId);
      $nameCandidat = $this->candidatModel->getNameCandidatById($payiement['candidatId']);
    } else {
      $hystory = $this->payiementModel->getHistrory($payiements[0]['id']);
      $nameCandidat = $this->candidatModel->getNameCandidatById($payiements[0]['candidatId']);
    }
    // init data for view
    $data = [
      'title' => 'Payiements',
      'menu' => 'payiements',
      'sub-menu' => 'payiements',
      'user' => $this->userConnected(),
      'payiements' => $payiements,
      'hystory' => $hystory,
      'nameCandidat' => $nameCandidat,
      'body_err' => $body_err,
    ];
    $this->view('payiement/index', $data);
  }
  public function add($idCandidat = null, $post = null)
  {
    // appel index
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $post == 'F56766') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // get payiement by id candidat
      $payiement = $this->payiementModel->getPayiementByCandidatId($idCandidat);
      $body = ['prix' => trim($_POST['prix']),];
      $body_err = ['prix_err' => '',];
      // validate : le type de prix doit ete un nombre positif
      if ($payiement['total'] == $payiement['totalPayie']) {
        $body_err['prix_err'] = 'Deja paye';
      } else if (!is_numeric($body['prix'])) {
        $body_err['prix_err'] = 'Entrer un nombre';
      } elseif (empty($body['prix'])) {
        $body_err['prix_err'] = 'Champ obligatoire';
      } elseif ($body['prix'] < 0) {
        $body_err['prix_err'] = 'Entrer un nombre positif';
      } else {
        if (
          $body['prix'] > ($payiement['total'] - $payiement['totalPayie']) ||
          $body['prix'] < 0
        ) $body_err['prix_err'] = 'prix invalide il doit etre entre 0 et ' . ($payiement['total'] - $payiement['totalPayie']);
      }
      //  make sure no errors
      if (empty($body_err['prix_err'])) {
        // init body data
        $body = [
          'prixPayie' => trim($_POST['prix']),
          'totalPayieNouveau' => $payiement['totalPayie'] + $body['prix'],
          'nouveauReste' => $payiement['total'] - $payiement['totalPayie'] - $body['prix'],
          'candidatId' => $idCandidat,
          'payiementId' => $payiement['id'],
        ];
        // update payiement
        if ($this->payiementModel->updatePayiement($body)) {
          flash('payiement_message', 'Payiement ajouté avec succès');
          redirect('payiements/index/' . $payiement['id']);
        } else {
          throw new Exception('Impossible d\'ajouter le payiement ! problème de base de données ou de connexion');
          die();
        }
      } else {
        // appel index avec les erreurs
        if($post != null) $body_err = '';
        $this->index($payiement['id'], $body_err);
      }
    } else {
      // redirect to index
      redirect('payiements');
      die;
    }
  }
}
