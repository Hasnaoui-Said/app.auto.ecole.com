<?php
class Payiement
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  // public add Payiement
  public function addPayiement($data)
  {
    $this->db->query('INSERT INTO `payiement`(`total`, `totalPayie`, `candidatId`) 
                      VALUES (:total, :totalPayie, :candidatId)');
    // Bind values
    $this->db->bind(':total', $data['prix']);
    $this->db->bind(':totalPayie', 0);
    $this->db->bind(':candidatId', $data['candidatId']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get payiement
  public function getPayiements()
  {
    $this->db->query(
      'SELECT payiement.*, payiement.id as `payiementId`, candidat.nom_fr as `nom`, candidat.id as `candidatId`
      FROM `payiement`
      inner join candidat on candidat.id = payiement.candidatId
      '
    );
    $rows = $this->db->resultSet();
    return $rows;
  }
  // get histrory payiement
  public function getHistrory($payiementId)
  {
    $this->db->query(
      'SELECT *, payiement.id as `payiementId`, histrorypayiement.id as `id`,
      histrorypayiement.totalPayie as `historyTotalPayie`,
      payiement.totalPayie as `totalPayie`
      FROM `histrorypayiement`
      inner join payiement on payiement.id = histrorypayiement.payiementId
      where histrorypayiement.payiementId = :payiementId ORDER BY histrorypayiement.datePayiement DESC');
    $this->db->bind(':payiementId', $payiementId);
    $rows = $this->db->resultSet();
    return count($rows) > 0 ? $rows : [];
  }
  // get payiement by id
  public function getPayiementById($payiementId)
  {
    $this->db->query(
      'SELECT * FROM `payiement` where payiement.id = :payiementId'
    );
    $this->db->bind(':payiementId', $payiementId);
    $row = $this->db->single();
    return $row;
  }
  // get payiement by id candidat
  public function getPayiementByCandidatId($candidatId)
  {
    $this->db->query(
      'SELECT * FROM `payiement` where payiement.candidatId = :candidatId'
    );
    $this->db->bind(':candidatId', $candidatId);
    $row = $this->db->single();
    return $row ? $row : [];
  }
  // update payiement
  public function updatePayiement($data)
  {
    $this->db->query('UPDATE `payiement` SET `totalPayie` = :totalPayieNouveau WHERE payiement.candidatId = :candidatId');
    // Bind values
    $this->db->bind(':totalPayieNouveau', $data['totalPayieNouveau']);
    $this->db->bind(':candidatId', $data['candidatId']);
    // execute
    if ($this->db->execute()) {
      // add history payiement
      $this->addHistoryPayiement($data);
      return true;
    } else {
      return false;
    }
  }
  // add history payiement
  public function addHistoryPayiement($data)
  {
    $this->db->query('INSERT INTO `histrorypayiement`(`reste`, `totalPayie`, `payiementId`)
                      VALUES (:nouveauReste, :prixPayie, :payiementId)');
    // Bind values
    $this->db->bind(':nouveauReste', $data['nouveauReste']);
    $this->db->bind(':prixPayie', $data['prixPayie']);
    $this->db->bind(':payiementId', $data['payiementId']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get total payiements
  public function getTotalPayiements()
  {
    $this->db->query(
      'SELECT sum(totalPayie) as `totalPayiements` FROM `payiement`'
    );
    $row = $this->db->single();
    return $row['totalPayiements'];
  }
}
