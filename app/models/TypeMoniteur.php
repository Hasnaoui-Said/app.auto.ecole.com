<?php
class TypeMoniteur
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getTypeMoniteurs()
  {
    $this->db->query('SELECT * FROM `typemoniteur`');
    return $this->db->resultSet();
  }
  
}