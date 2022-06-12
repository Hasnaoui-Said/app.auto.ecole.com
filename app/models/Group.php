<?php
class Group
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getGroups()
  {
    $this->db->query('SELECT * FROM groupformation
                      WHERE groupformation.status = 1 ORDER BY dateCreate DESC
                      ');
    return $this->db->resultSet();
  }
  public function getCandidats()
  {
    $this->db->query('SELECT groupeleve.*, utilisateur.username, candidat.cin, utilisateur.email  FROM groupeleve 
                      INNER JOIN candidat ON groupeleve.idCandidat = candidat.id
                      INNER JOIN utilisateur ON utilisateur.username = candidat.username WHERE utilisateur.status = 1
                    ');
    return $this->db->resultSet();
  }
     public function addGroup($data){
      $this->db->query("INSERT INTO `groupformation`(`nomGroup`, `description`, `dateCreate`) 
                        VALUES (:nomGroup, :description, :dateCreate)");
      // Bind values
      $this->db->bind(':nomGroup', $data['nomGroup']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':dateCreate', $data['dateCreate']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateGroup($data){
      $this->db->query('UPDATE groupformation SET nomGroup = :nomGroup, 
                        description = :description, dateCreate = :dateCreate WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':nomGroup', $data['nomGroup']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':dateCreate', $data['dateCreate']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getGroupById($id){
      $this->db->query('SELECT * FROM groupformation WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteGroup($id){
      $this->db->query('DELETE FROM groupformation WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
}