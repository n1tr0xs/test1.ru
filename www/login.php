<?php

session_start();

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);

  $ALL_USERS = array(
    'user' => 'users',
    'operator' => 'operators',
    'crewmember' => 'crewmembers'
  );
  foreach ($ALL_USERS as $t=>$db) {
    $result = $conn->query("SELECT id, login, password from ". $db. " where login=\"". $uname. "\" and password=\"". $pass. "\"");

    if(mysqli_num_rows($result)){
      $r = $result->fetch_assoc();
      $_SESSION['user'] = $uname;
      $_SESSION['uid'] = $r['id'];
      $_SESSION['user_type'] = $t;
      header("Location: /index.php");
      break;
    }
    else {
      header("Location: /login.html?error=login");
    }
  }
}
