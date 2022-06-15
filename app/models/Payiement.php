<?php
class Payiement
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  // public add Payiement
  public function addPayiement($data)
  {
    $this->db->query('INSERT INTO `payiement`(`total`, `totalPayie`, `candidatId`) 
                      VALUES (:total, :totalPayie, :candidatId)');
    // Bind values
    $this->db->bind(':total', $data['prix']);
    $this->db->bind(':totalPayie', $data['reste']);
    $this->db->bind(':candidatId', $data['candidatId']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
}
