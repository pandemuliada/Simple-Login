<?php 

  // Start session before destroy the session
  session_start();

  unset($_SESSION['user']);
  unset($_SESSION['is_login']);

  header("Location: login.php");