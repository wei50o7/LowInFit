<?php

  session_start();
  session_unset();
  session_destroy();

  setcookie("user", "", time()-10000, '/');
  setcookie("usert", "", time()-10000, '/');

  header('Location: ../index.php');
