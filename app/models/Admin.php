<?php
class Admin
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  // get Admin data by id User
  public function getAdminByIdUser($id)
  {
    $this->db->query('SELECT * FROM `administrateur` 
                      inner join utilisateur on administrateur.userId = utilisateur.id 
                      where administrateur.userId = :id');
    $this->db->bind(':id', $id);
    
    $row = $this->db->single();
    
    return $row ? $row : [];
  }
  
  
}