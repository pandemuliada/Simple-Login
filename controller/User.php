<?php

  // Extends User class with Database class
  // The User class now can use the Database class property & method such as ($this->connect(), $this->query(), etc)
  class User extends Database
  {
    // Login method
    // This method receive two parameters (email & password)
    public function login($email, $password) {
      $sql = "SELECT * FROM v_users WHERE email = '$email' AND password = '$password'";
      $query = $this->connect()->query($sql);
      $result = $query->fetch(PDO::FETCH_OBJ);
      
      // It will return 
      return $result;
    }
    
    public function register($name, $email, $id_level, $password)
    {
      $sql = "INSERT INTO users (name, email, id_level, password) VALUES ('$name', '$email', '$id_level', '$password')";
      $query = $this->connect()->prepare($sql);
      $result = $query->execute();
      
      return $result;
    }

    public function currentUser()
    {
      // Get the current logged in user
      if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
      }
    }
  }

  
  