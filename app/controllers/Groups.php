<?php
class Groups extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect();
    }
    $this->groupModel = $this->model('Group');
    $this->candidatModel = $this->model('Candidat');
  }
  public function index()
  {
    // Get data groups
    $groups = $this->groupModel->getGroups();
    $candidats = $this->groupModel->getCandidats();
    $data = [
      'title' => 'Groups',
      'menu' => 'groups',
      'sub-menu' => 'groups',
      'user' => [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'role' => 'role',
      ],
      'groups' => $groups,
      'candidatsGrp' => $candidats,
    ];
    $this->view('groups/index', $data);
  }
  public function add()
  {
    // get data candidats
    $candidats = $this->groupModel->getCandidats();
    // get data candidats
    $allCandidats = $this->candidatModel->getCandidats();
    // init body
    $body = [
      'nomGroup' => '',
      'description' => '',
      'candidats' => [],
    ];
    // Init body error
    $body_err = [
      'nomGroup_err' => '',
      'description_err' => '',
      'candidats_err' => '',
    ];
    // If method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init body
      $body = [
        'nomGroup' => trim($_POST['nomGroup']),
        'description' => trim($_POST['description']),
        'candidats' => $_POST['candidats'] ?? [],
      ];
      // Init body error
      $body_err = [
        'nomGroup_err' => '',
        'description_err' => '',
      ];
      // Validate body
      if (empty($body['nomGroup'])) {
        $body_err['nomGroup_err'] = 'Ce champ est obligatoire';
      }
      // validate nom group different from other groups
      if (count($this->groupModel->findGroupByName($body['nomGroup'])) > 0) {
        $body_err['nomGroup_err'] = 'Ce nom de groupe existe déjà';
      }
      // Make sure no errors
      if (empty($body_err['nomGroup_err'])) {
        // Validate body and add group
        if ($this->groupModel->addGroup($body)) {
          flash('group_message', 'Group a ete ajoute avec succes');
          redirect('groups');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        // init data
        $data = [
          'title' => 'Add Group',
          'menu' => 'groups',
          'sub-menu' => 'addGroup',
          'action' => 'add',
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
          'body' => $body,
          'body_err' => $body_err,
          'candidats' => $candidats,
        ];
        $this->view('groups/add', $data);
      } // end else
    } else {
      // Init body
      $data = [
        'title' => 'Crée un nouveau group:',
        'menu' => 'groups',
        'sub-menu' => 'addGroup',
        'action' => 'add',
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
        'body' => $body,
        'body_err' => $body_err,
        'candidats' => $candidats,
        'allCandidats' => $allCandidats,
      ];
      $this->view('groups/add', $data);
    }
  }
  public function edit($id)
  {
    // Get group from model
    $group = $this->groupModel->getGroupById($id);
    // init body
    $body = [
      'id' => $group['id'],
      'nomGroup' => $group['nomGroup'],
      'description' => $group['description'],
    ];
    // init body error
    $body_err = [
      'nomGroup_err' => '',
      'description_err' => '',
    ];
    // If method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // Init body
      $body = [
        'id' => $group['id'],
        'nomGroup' => trim($_POST['nomGroup']),
        'description' => trim($_POST['description']),
      ];
      // Validate body
      if (empty($body['nomGroup'])) {
        $body_err['nomGroup_err'] = 'Ce champ est obligatoire';
      } else {
        // find group by name different from current group
        if (count($this->groupModel->findGroupByNameDifferent($body['nomGroup'], $body['id'])) > 0) {
          $body_err['nomGroup_err'] = 'Ce nom de groupe existe déjà';
        }
      }
      // Make sure no errors
      if (empty($body_err['nomGroup_err'])) {
        // Validate body and add group
        if ($this->groupModel->updateGroup($body)) {
          flash('group_message', 'Group a ete modifie avec succes');
          redirect('groups');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        // init data
        $data = [
          'title' => 'Edit Group',
          'menu' => 'groups',
          'action' => 'edit',
          'sub-menu' => 'addGroup',
          'id' => $group['id'],
          'user' => [
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'role' => 'role',
          ],
          'body' => $body,
          'body_err' => $body_err,
        ];
        $this->view('groups/add', $data);
      } // end else
    } else {
      // Init body
      $data = [
        'title' => 'Edit Group',
        'menu' => 'groups',
        'action' => 'edit',
        'sub-menu' => 'addGroup',
        'user' => [
          'id' => 'id',
          'name' => 'name',
          'email' => 'email',
          'role' => 'role',
        ],
        'body' => $body,
        'body_err' => $body_err,
      ];
      $this->view('groups/add', $data);
    }
  }
  // desactivate group
  public function desactivate($id)
  {
    if ($this->groupModel->desactivateGroup($id)) {
      flash('group_message', 'Group a ete desactive avec succes');
      redirect('groups');
    } else {
      die('Something went wrong');
    }
  }
  // Delete group
  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if ($this->groupModel->deleteGroup($id)) {
        flash('group_message', 'Group a ete supprime avec succes');
        redirect('groups');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('groups');
    }
  }
}
