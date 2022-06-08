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
                      ON candidat.username = utilisateur.username
                      INNER JOIN typeFormation
                      ON candidat.typeFormation = typeFormation.id
                      INNER JOIN permis
                      ON permis.id = candidat.permisId
                      WHERE utilisateur.status = 1
                      ');
    // print_r($this->db->resultSet()[0]);
    // die();
    return $this->db->resultSet();
  }
  public function search($search)
  {
    $this->db->query("SELECT *,
                      typeFormation.descriprion as `formationDesc`,
                      permis.descriprion as `permisDesc`
                      FROM `candidat`
                      INNER JOIN utilisateur
                      ON candidat.username = utilisateur.username
                      INNER JOIN typeFormation
                      ON candidat.typeFormation = typeFormation.id
                      INNER JOIN permis
                      ON permis.id = candidat.permisId
                      WHERE utilisateur.status = 1 AND 
                      (candidat.nom_fr LIKE '%$search%' OR
                       candidat.prenom_fr LIKE '%$search%' OR
                       candidat.username LIKE '%$search%'OR
                       utilisateur.email LIKE '%$search%'
                       )
                      ");
    // print_r($this->db->resultSet()[0]);
    // die();
    return $this->db->resultSet();
  }
}