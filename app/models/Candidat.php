<?php
class Candidat
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getCandidats($limit = 10)
  {
    $this->db->query("SELECT *,
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
                        ORDER BY utilisateur.dateCreate DESC LIMIT :limit
                      ");
    $this->db->bind(':limit', $limit, PDO::PARAM_INT);
    $row = $this->db->resultSet();
    return $row;
  }
  public function getAllCandidats($limit = 10)
  {
    $this->db->query("SELECT *,
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
                        WHERE 1
                        ORDER BY utilisateur.status DESC, utilisateur.dateCreate DESC LIMIT :limit
                      ");
    $this->db->bind(':limit', $limit, PDO::PARAM_INT);
    $row = $this->db->resultSet();
    return $row;
  }
  public function search($search)
  {
    $search = '%' . $search . '%';
    $this->db->query("SELECT *,
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
                      WHERE 1 AND 
                      ( candidat.nom_fr LIKE '$search' OR
                        candidat.prenom_fr LIKE '$search' OR
                        utilisateur.username LIKE '$search'OR
                        candidat.cin LIKE '$search'OR
                        candidat.phone LIKE '$search'OR
                        permis.Categorie LIKE '$search'OR
                        utilisateur.email LIKE '$search'
                       )
                      ");
    // $this->db->bind(':search', $search, PDO::PARAM_STR);
    $row = $this->db->resultSet();
    return $row;
  }
  public function getCandidatByUsername($user)
  {
    $this->db->query('SELECT candidat.*, utilisateur.username FROM candidat
                      INNER JOIN utilisateur ON utilisateur.id = candidat.userId 
                      WHERE username = :username');
    $this->db->bind(':username', $user);

    $row = $this->db->single();
    return $row ? $row : [];
  }

  public function getCandidatById($id)
  {
    $this->db->query(
      'SELECT *,
                      typeFormation.descriprion as `formationDesc`,
                      candidat.id as `candidatId`,
                      permis.descriprion as `permisDesc`,
                      utilisateur.image as `UserImg`
                      FROM `candidat`
                      INNER JOIN utilisateur
                      ON candidat.userId = utilisateur.id
                      INNER JOIN typeFormation
                      ON candidat.typeFormation = typeFormation.id
                      INNER JOIN permis
                      ON permis.id = candidat.permisId
                      INNER JOIN Payiement
                      ON Payiement.candidatId = candidat.id
                      WHERE utilisateur.status = 1 AND candidat.id = :id'
    );
    $this->db->bind(':id', $id);

    $row = $this->db->single();
    return $row ? $row : [];
  }
  // add candidat
  public function addCandidat($data)
  {
    $this->db->query("INSERT INTO candidat(userId, nom_fr, nom_ar, prenom_fr, prenom_ar, 
                      date_naiss, lieu_naiss, lieu_naiss_Ar, ville, adresse, adresse_ar, phone, cin, 
                      dateDebutThe, dateDebutPra, nbr_heure_theorique, nbr_heure_pratique, 
                      n_siteMini, numContrat, permisId, sexe, typeFormation) 
                      VALUES (:userId, :nom_fr, :nom_ar, :prenom_fr, :prenom_ar, 
                      :date_naiss, :lieu_naiss, :lieu_naiss_Ar, :ville, :adresse, :adresse_ar, :phone, :cin, 
                      :dateDebutThe, :dateDebutPra, :nbr_heure_theorique, :nbr_heure_pratique, 
                      :n_siteMini, :numContrat, :permisId, :sexe, :typeFormation)
              ");
    // Bind values
    $this->db->bind(':userId', $data['idUser']);
    $this->db->bind(':nom_fr', $data['nom']);
    $this->db->bind(':nom_ar', $data['nomAr']);
    $this->db->bind(':prenom_fr', $data['prenom']);
    $this->db->bind(':prenom_ar', $data['prenomAr']);
    $this->db->bind(':date_naiss', $data['dateNaiss']);
    $this->db->bind(':lieu_naiss', $data['lieuNais']);
    $this->db->bind(':lieu_naiss_Ar', $data['lieuNaissAr']);
    $this->db->bind(':ville', $data['ville']);
    $this->db->bind(':adresse', $data['adresse']);
    $this->db->bind(':adresse_ar', $data['adresse_ar']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':cin', $data['cin']);
    $this->db->bind(':dateDebutThe', $data['dateDebutTher']);
    $this->db->bind(':dateDebutPra', $data['dateDebutPra']);
    $this->db->bind(':nbr_heure_theorique', $data['nbrHeurThe']);
    $this->db->bind(':nbr_heure_pratique', $data['nbrHeurPra']);
    $this->db->bind(':n_siteMini', $data['numSite']);
    $this->db->bind(':numContrat', $data['numContrat']);
    $this->db->bind(':permisId', $data['categorie']);
    $this->db->bind(':sexe', $data['sexe']);
    $this->db->bind(':typeFormation', $data['typeFormation']);
    // execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // update candidat

  public function updateCandidat($data)
  {
    $this->db->query("UPDATE `candidat` SET nom_fr = :nom_fr, nom_ar = :nom_ar, prenom_fr = :prenom_fr, prenom_ar = :prenom_ar, 
                      date_naiss = :date_naiss, lieu_naiss = :lieu_naiss, lieu_naiss_Ar = :lieu_naiss_Ar, ville = :ville, adresse = :adresse,
                      adresse_ar = :adresse_ar, phone = :phone, cin = :cin,
                      nbr_heure_theorique = :nbr_heure_theorique, nbr_heure_pratique = :nbr_heure_pratique, n_siteMini = :n_siteMini,
                      numContrat = :numContrat, permisId = :permisId, sexe = :sexe, typeFormation = :typeFormation
                      WHERE candidat.id = :candidatId
              ");
    // Bind values
    $this->db->bind(':candidatId', $data['candidatId']);
    $this->db->bind(':nom_fr', $data['nom']);
    $this->db->bind(':nom_ar', $data['nomAr']);
    $this->db->bind(':prenom_fr', $data['prenom']);
    $this->db->bind(':prenom_ar', $data['prenomAr']);
    $this->db->bind(':date_naiss', $data['dateNaiss']);
    $this->db->bind(':lieu_naiss', $data['lieuNais']);
    $this->db->bind(':lieu_naiss_Ar', $data['lieuNaissAr']);
    $this->db->bind(':ville', $data['ville']);
    $this->db->bind(':adresse', $data['adresse']);
    $this->db->bind(':adresse_ar', $data['adresse_ar']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':cin', $data['cin']);
    $this->db->bind(':nbr_heure_theorique', $data['nbrHeurThe']);
    $this->db->bind(':nbr_heure_pratique', $data['nbrHeurPra']);
    $this->db->bind(':n_siteMini', $data['numSite']);
    $this->db->bind(':numContrat', $data['numContrat']);
    $this->db->bind(':permisId', $data['categorie']);
    $this->db->bind(':sexe', $data['sexe']);
    $this->db->bind(':typeFormation', $data['typeFormation']);
    // execute

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  // get candidat data by id User
  public function getCandidatByIdUser($id)
  {
    $this->db->query("SELECT *, candidat.id as `id`, candidat.nom_fr as `nom`, candidat.prenom_fr as `prenom`  
                      FROM `candidat` INNER JOIN utilisateur ON utilisateur.id = candidat.userId 
                      WHERE utilisateur.id = :id");
    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row ? $row : [];
  }
}
