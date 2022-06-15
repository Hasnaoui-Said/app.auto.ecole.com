<?php
class Examen
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  // public add Payiement
  public function adExamen($data)
  {
    $this->db->query('`examen`(`typeExamen`) 
                      VALUES (:typeExamen)');
    // Bind values
    $this->db->bind(':typeExamen', $data['typeExamen']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
}
