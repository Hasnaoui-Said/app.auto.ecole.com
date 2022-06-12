<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Create a new Candidat
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

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
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
    public function getUserByEmail($email)
    {
      $this->db->query('SELECT * FROM utilisateur WHERE email = :email');
      $this->db->bind(':email', $email);
  
      $row = $this->db->single();
      return $row ? $row : [];
    }
    // // Get User by ID
    // public function getUserById($id){
    //   $this->db->query('SELECT * FROM users WHERE id = :id');
    //   // Bind value
    //   $this->db->bind(':id', $id);

    //   $row = $this->db->single();

    //   return $row;
    // }
  }