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
                      INNER JOIN utilisateur ON utilisateur.id = candidat.userId WHERE utilisateur.status = 1
                    ');
    return $this->db->resultSet();
  }
  // get candidats by group id
  public function getCandidatsByGroupId($id)
  {
    $this->db->query('SELECT *, candidat.id as `candidatId` FROM candidat INNER JOIN groupeleve ON candidat.id = groupeleve.idCandidat
    INNER JOIN utilisateur ON candidat.userId = utilisateur.id
    WHERE groupeleve.idGroup = :id');
    // Bind value
    $this->db->bind(':id', $id);
    return $this->db->resultSet();
  }
  public function addGroup($data)
  {
    $this->db->query("INSERT INTO `groupformation`(`nomGroup`, `description`) 
                        VALUES (:nomGroup, :description)");
    // Bind values
    $this->db->bind(':nomGroup', $data['nomGroup']);
    $this->db->bind(':description', $data['description']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getGroupById($id)
  {
    $this->db->query("SELECT * FROM `groupformation` WHERE id = :id");
    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row ? $row : [];
  }
  public function updateGroup($data)
  {
    $this->db->query('UPDATE groupformation SET nomGroup = :nomGroup, 
                        description = :description WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':nomGroup', $data['nomGroup']);
    $this->db->bind(':description', $data['description']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // desactivate group
  public function desactivateGroup($id)
  {
    $this->db->query('UPDATE groupformation SET status = 0 WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // find group by name
  public function findGroupByName($name)
  {
    $this->db->query('SELECT * FROM groupformation WHERE nomGroup = :name');
    // Bind values
    $this->db->bind(':name', $name);
    $row = $this->db->single();
    return $row ? $row : [];
  }
  // find group by name different from current group
  public function findGroupByNameDifferent($name, $id)
  {
    $this->db->query('SELECT * FROM groupformation WHERE nomGroup = :name AND id != :id');
    // Bind values
    $this->db->bind(':name', $name);
    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row ? $row : [];
  }
  
}
