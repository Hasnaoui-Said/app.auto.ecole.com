<?php
class Candidat
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getCandidats()
  {
    $this->db->query('SELECT *,
                      typeFormation.descriprion as `formationDesc`,
                      permis.descriprion as `permisDesc`
                      FROM `candidat`
                      INNER JOIN utilisateur
                      ON candidat.userId = utilisateur.id
                      INNER JOIN typeFormation
                      ON candidat.typeFormation = typeFormation.id
                      INNER JOIN permis
                      ON permis.id = candidat.permisId
                      WHERE utilisateur.status = 1
                      ');
    
    return $this->db->resultSet();
  }
  public function search($search)
  {
    $this->db->query("SELECT *,
                      typeFormation.descriprion as `formationDesc`,
                      permis.descriprion as `permisDesc`
                      FROM `candidat`
                      INNER JOIN utilisateur
                      ON candidat.userId = utilisateur.id
                      INNER JOIN typeFormation
                      ON candidat.typeFormation = typeFormation.id
                      INNER JOIN permis
                      ON permis.id = candidat.permisId
                      WHERE utilisateur.status = 1 AND 
                      ( candidat.nom_fr LIKE '%$search%' OR
                        candidat.prenom_fr LIKE '%$search%' OR
                        utilisateur.username LIKE '%$search%'OR
                        candidat.cin LIKE '%$search%'OR
                        permis.Categorie LIKE '%$search%'OR
                        utilisateur.email LIKE '%$search%'
                       )
                      ");
    
    return $this->db->resultSet();
  }
  public function getCandidatByUsername($user)
  { 
    $this->db->query('SELECT candidat.*, utilisateur.username FROM candidat
                      INNER JOIN utilisateur ON utilisateur.id = candidat.userId WHERE username = :username');
    $this->db->bind(':username', $user);

    $row = $this->db->single();
    return $row ? $row : [];
  }
    public function getCandidatById($id)
  {
    $this->db->query('SELECT * FROM candidat WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();
    return $row ? $row : [];
  }
  
}
