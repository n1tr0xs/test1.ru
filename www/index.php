<?php
session_start();

if (isset($_SESSION['user'])){
    switch ($_SESSION['user_type']) {
      case 'user':
        header("location: /user_page.php");
        break;
      case 'operator':
        header("location: /operator_page.php");
        break;
      case 'crewmember':
        header("location: /crewmember_page.php");
        break;
    }
}
else {
  header("Location: /login.php");
}
 ?>
