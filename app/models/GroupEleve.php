<?php
class GroupEleve
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getCandidatsByGroupId()
  {
    $this->db->query('SELECT *,
                      typeFormation.descriprion as `formationDesc`,
                      candidat.id as `candidatId`,
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
  
}
