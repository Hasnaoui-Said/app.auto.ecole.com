<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Create a new Utilisateur
    public function addUser($data){
      $this->db->query('INSERT INTO `utilisateur`(`username`, `email`, `password`, `roleId`)
                        VALUES(:username, :email, :password, :roleId)');
      // Bind values
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':roleId', 4);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM utilisateur  WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row['password'];
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }
    // find user by username
    public function findUserByUsername($username){
      $this->db->query('SELECT * FROM utilisateur WHERE username = :username');
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
    // find user by username different from current user
    public function findUserByUsernameDifferent($username, $id){
      $this->db->query('SELECT * FROM utilisateur WHERE username = :username AND id != :id');
      $this->db->bind(':username', $username);
      $this->db->bind(':id', $id);

      // $row = $this->db->single();

      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
    // Find user by email different from current user
    public function findUserByEmailDifferent($email, $id){
      $this->db->query('SELECT * FROM utilisateur WHERE email = :email AND id != :id');
      // Bind value
      $this->db->bind(':email', $email);
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM utilisateur WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
    // get user by username
    public function getUserByUsername($username){
      $this->db->query('SELECT * FROM utilisateur WHERE username = :username');
      // Bind value
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      return  $row ? $row : [];
    }
    public function getUserByEmail($email)
    {
      $this->db->query('SELECT * FROM utilisateur WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);
  
      $row = $this->db->single();

      return $row ? $row : [];
    }
    
    // Get User by ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM utilisateur WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row ? $row : [];
    }
    // update user
    public function updateUser($data){
      $this->db->query('UPDATE utilisateur SET username = :username, email = :email WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['userId']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    // desactivate user
    public function desactivateUser($id){
      $this->db->query('UPDATE utilisateur SET status = :status WHERE id = :id');
      // Bind value
      $this->db->bind(':status', 0);
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }