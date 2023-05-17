<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div id='content' class='content'>
    <?
    $uid = $_SESSION['uid'];
    $result = $conn->query("SELECT * from requests where user_id=$uid");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    if($rows){
      echo "Ваши заявки:";
      foreach ($rows as $row) {
        print_request_for_user($row);
      }
    }
    else{
      echo "У вас нет заявок.";
    }
    ?>
  </div>
  <? include "footer.php" ?>
</body>
</html>
