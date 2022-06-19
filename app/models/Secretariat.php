<?php
class Secretariat
{
  private $db;
  
  public function __construct()
  {
    $this->db = new Database;
  }
  // get Secretariat data by id User
  public function getSecretariatByIdUser($id)
  {
    $this->db->query('SELECT * FROM secretariat 
                      inner join utilisateur on secretariat.userId = utilisateur.id 
                      WHERE userId = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row ? $row : [];
  }
}
