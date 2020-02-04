<?php

  class Database
  {

    // Class property
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "simple-login";
    public $conn;
    
    public function connect()
    {
      try {
        // Connect to database using PDO
        // Remember to user keyword "this" to get this class property (Database Class)
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); // IDKW if I delete this error will occur
        
        return $this->conn;
      } catch (PDOException $e) {
        echo $e->getMessage(); // Get the error message
      }
    }

    public function query($query)
    {
      return $this->connect()->query($query)->fetchAll(PDO::FETCH_OBJ);
    }

    public function disconnect()
    {
      $this->conn = null;
    }

  }
  