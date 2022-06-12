<?php
class Permis
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getPermis()
  {
    $this->db->query('SELECT * FROM `permis`');
    return $this->db->resultSet();
  }
  
}