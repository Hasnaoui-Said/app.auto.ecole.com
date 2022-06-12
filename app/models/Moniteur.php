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
      'SELECT moniteur.*, typemoniteur.type, utilisateur.username, utilisateur.email 
                      FROM moniteur
                      INNER JOIN utilisateur ON utilisateur.username = moniteur.username 
                      INNER JOIN typemoniteur ON typemoniteur.id = moniteur.typeMoniteurId 
                      WHERE utilisateur.status = 1'
    );
    return $this->db->resultSet();
  }
  public function search($search)
  {
    // Get data Moniteurs 
    $this->db->query("SELECT moniteur.*, typemoniteur.type, utilisateur.username, utilisateur.email 
                      FROM moniteur
                      INNER JOIN utilisateur ON utilisateur.username = moniteur.username 
                      INNER JOIN typemoniteur ON typemoniteur.id = moniteur.typeMoniteurId 
                      WHERE utilisateur.status = 1 AND 
                      (
                        moniteur.username LIKE '%$search%' OR
                        utilisateur.email LIKE '%$search%' OR
                        moniteur.nom LIKE '%$search%' OR
                        moniteur.prenom LIKE '%$search%' OR
                        moniteur.num_cpa LIKE '%$search%'OR
                        typemoniteur.type LIKE '%$search%'
                       )
                      ");
    return $this->db->resultSet();
  }


  public function addMoniteur($data)
  {
    $this->db->query("INSERT INTO `moniteur`(`username`, `nom`, `prenom`, `typeMoniteurId`, `num_cpa`, `date_cpa`)
                      VALUES (:username, :nom, :prenom, :typeMoniteurId, :num_cpa, :date_cpa)");
    // Bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':nom', $data['nom']);
    $this->db->bind(':prenom', $data['prenom']);
    $this->db->bind(':typeMoniteurId', $data['typeMoniteurId']);
    $this->db->bind(':num_cpa', $data['num_cpa']);
    $this->db->bind(':date_cpa', $data['date_cpa']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateMoniteur($data)
  {
    $this->db->query('UPDATE moniteur SET username = :username, 
                      description = :description, dateCreate = :dateCreate WHERE id = :id');
    // Bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':nom', $data['nom']);
    $this->db->bind(':prenom', $data['prenom']);
    $this->db->bind(':typeMoniteurId', $data['typeMoniteurId']);
    $this->db->bind(':num_cpa', $data['num_cpa']);
    $this->db->bind(':date_cpa', $data['date_cpa']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getMoniteurById($id)
  {
    $this->db->query('SELECT * FROM groupformation WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function deleteMoniteur($id)
  {
    $this->db->query('DELETE FROM groupformation WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
