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
}