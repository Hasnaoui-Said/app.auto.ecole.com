<?php
class Moniteur
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getMoniteurs()
  {
    // Get data Moniteurs 
    $this->db->query(
      'SELECT moniteur.*, typemoniteur.* , utilisateur.*, moniteur.id as `id`
                      FROM moniteur
                      INNER JOIN utilisateur ON utilisateur.id = moniteur.userId 
                      INNER JOIN typemoniteur ON typemoniteur.id = moniteur.typeMoniteurId 
                      WHERE utilisateur.status = 1 ORDER BY utilisateur.dateCreate DESC LIMIT :limit'
    );
    $this->db->bind(':limit', 10, PDO::PARAM_INT);
    return $this->db->resultSet();
  }
  public function getAllMoniteurs($limit = 10)
  {
    // Get data Moniteurs 
    $this->db->query(
      'SELECT moniteur.*, typemoniteur.* , utilisateur.*, moniteur.id as `id`
                      FROM moniteur
                      INNER JOIN utilisateur ON utilisateur.id = moniteur.userId 
                      INNER JOIN typemoniteur ON typemoniteur.id = moniteur.typeMoniteurId 
                      WHERE 1 ORDER BY utilisateur.status DESC, utilisateur.dateCreate DESC LIMIT :limit'
    );
    $this->db->bind(':limit', $limit, PDO::PARAM_INT);
    $row = $this->db->resultSet();
    return $row;
  }
  public function search($search)
  {
    $search = '%' . $search . '%';
    // Get data Moniteurs 
    $this->db->query("SELECT moniteur.*, typemoniteur.*, utilisateur.*, moniteur.id as `id`
                      FROM moniteur
                      INNER JOIN utilisateur ON utilisateur.id = moniteur.userId 
                      INNER JOIN typemoniteur ON typemoniteur.id = moniteur.typeMoniteurId 
                      WHERE 1 AND 
                      (
                        utilisateur.username LIKE '$search' OR
                        utilisateur.email LIKE '$search' OR
                        moniteur.nom LIKE '$search' OR
                        moniteur.prenom LIKE '$search' OR
                        moniteur.num_cpa LIKE '$search'OR
                        moniteur.phone LIKE '$search'OR
                        typemoniteur.type LIKE '$search'
                       ) ORDER BY utilisateur.status DESC, utilisateur.dateCreate DESC
                      ");
    return $this->db->resultSet();
  }

  public function addMoniteur($data)
  {
    $this->db->query("INSERT INTO `moniteur`(`userId`, `nom`, `prenom`, `typeMoniteurId`, `num_cpa`, `date_cpa`, `phone`)
                      VALUES (:userId, :nom, :prenom, :typeMoniteurId, :num_cpa, :date_cpa, :phone)");
    // Bind values
    $this->db->bind(':userId', $data['userId']);
    $this->db->bind(':nom', $data['nom']);
    $this->db->bind(':prenom', $data['prenom']);
    $this->db->bind(':typeMoniteurId', $data['typeMoniteur']);
    $this->db->bind(':num_cpa', $data['num_cpa']);
    $this->db->bind(':date_cpa', $data['date_cpa']);
    $this->db->bind(':phone', $data['phone']);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get moniteur by id
  public function getMoniteurById($id)
  {
    $this->db->query('SELECT * FROM moniteur WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row ? $row : [];
  }
  // DELETE moniteur
  public function deleteMoniteur($id)
  {
    $this->db->query('DELETE FROM moniteur WHERE id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // desactivate moniteur
  public function desactivateMoniteur($id)
  {
    $this->db->query('UPDATE utilisateur SET status = 0 WHERE id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // activate moniteur
  public function activateMoniteur($id)
  {
    $this->db->query('UPDATE utilisateur SET status = 1 WHERE id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // Update Moniteur
  public function updateMoniteur($data)
  {
    $this->db->query('UPDATE moniteur SET prenom = :prenom, nom = :nom, 
                      typeMoniteurId = :typeMoniteurId, num_cpa = :num_cpa, 
                      date_cpa = :date_cpa, phone = :phone WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['moniteurId']);
    $this->db->bind(':nom', $data['nom']);
    $this->db->bind(':prenom', $data['prenom']);
    $this->db->bind(':typeMoniteurId', $data['typeMoniteur']);
    $this->db->bind(':num_cpa', $data['num_cpa']);
    $this->db->bind(':date_cpa', $data['date_cpa']);
    $this->db->bind(':phone', $data['phone']);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get moniteur data by id User
  public function getMoniteurByIdUser($id)
  {
    $this->db->query('SELECT * FROM `moniteur` WHERE userId = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row ? $row : [];
  }
  // get count moniteurs
  public function getCountMoniteurs()
  {
    $this->db->query('SELECT count(*) as `count` FROM moniteur');
    $row = $this->db->single();
    return $row['count'];
  }
}
