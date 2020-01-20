<?php

  class Database
  {

    // Class property
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "simple-login";
    protected $conn;

    // construct function will automaticaly run after instantiation of this class
    public function __construct() {
      try {
        // Connect to database using PDO
        // Remember to user keyword "this" to get this class property (Database Class)
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); // IDKW if I delete this error will occur
      
      } catch (PDOException $e) {
        echo $e->getMessage(); // Get the error message
      }
    }
    
    public function disconect()
    {
      $this->conn = null;
    }

  }
  