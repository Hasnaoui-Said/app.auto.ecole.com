<?php
class Resultatexamen
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  // public add Payiement
  public function addResultatexamen($data)
  {
    $this->db->query('INSERT INTO `resultatexamen`( `dateExamen_1`, `dateExamen_2`, `candidatId`, `examenId`) 
                      VALUES (:dateExamen_1,:dateExamen_2,:candidatId,:examenId)');
    // Bind values
    $this->db->bind(':dateExamen_1', $data['dateExamen1']);
    $this->db->bind(':dateExamen_2', $data['dateExamen2']);
    $this->db->bind(':candidatId', $data['candidatId']);
    $this->db->bind(':examenId', $data['examenId']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
}
