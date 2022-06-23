<?php
class Vehicule
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getVehicules()
  {
    // Get data Vehicules 
    $this->db->query('SELECT * FROM vehicule');
    return $this->db->resultSet();
  }
  
  public function search($search)
  {
    $this->db->query("SELECT * FROM vehicule WHERE
                      (marque LIKE '%$search%' OR
                       model LIKE '%$search%' OR
                       matricule LIKE '%$search%'
                       )
                      ");
    return $this->db->resultSet();
  }
  public function addVehicule($data)
  {
    // Get data Vehicules 
    $this->db->query('INSERT INTO vehicule (marque, model, matricule, visiteTechnique, assurance, vidange) 
                      VALUES (:marque, :model, :matricule, :visiteTechnique, :assurance, :vidange)');
    // Bind values
    $this->db->bind(':marque', $data['marque']);
    $this->db->bind(':model', $data['modele']);
    $this->db->bind(':matricule', $data['matricule']);
    $this->db->bind(':visiteTechnique', $data['date_visite']);
    $this->db->bind(':assurance', $data['date_assurance']);
    $this->db->bind(':vidange', $data['date_vidange']);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getVehiculeById($id)
  {
    $this->db->query('SELECT * FROM vehicule WHERE id = :id');
    $this->db->bind(':id', $id);
    return $this->db->single();
  }
  public function updateVehicule($data)
  {
    // Get data Vehicules 
    $this->db->query('UPDATE vehicule SET marque = :marque, model = :model, 
    matricule = :matricule, visiteTechnique = :visiteTechnique, assurance = :assurance, 
    vidange = :vidange WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':marque', $data['marque']);
    $this->db->bind(':model', $data['modele']);
    $this->db->bind(':matricule', $data['matricule']);
    $this->db->bind(':visiteTechnique', $data['date_visite']);
    $this->db->bind(':assurance', $data['date_assurance']);
    $this->db->bind(':vidange', $data['date_vidange']);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteVehicule($id)
  {
    // Get data Vehicules 
    $this->db->query('DELETE FROM vehicule WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get count vehicules
  public function getCountVehicules()
  {
    $this->db->query('SELECT COUNT(*) as count FROM vehicule');
    $row = $this->db->single();
    return $row['count'];
  }
}