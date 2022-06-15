<?php
class TypeFormation
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getTypeFormations()
  {
    $this->db->query('SELECT * FROM `typeFormation`');
    return $this->db->resultSet();
  }
  
}