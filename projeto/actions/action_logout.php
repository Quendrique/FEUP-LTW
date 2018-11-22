<?php
  include_once('../includes/incl_session.php');
  
  session_destroy();

  header('Location: ../pages/mainpage.php');
?>