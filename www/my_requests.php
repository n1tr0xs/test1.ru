<?php
session_start();
include 'db_conn.php';

$result = $conn->query('SELECT * from requests where user_id='.$_SESSION['uid']);
if($result){
  $rows = $result->fetch_all(MYSQLI_ASSOC);
  foreach ($rows as $row) {
    echo $row['type_id'].' '. $row['category_id'].' '. $row['status'].' '. $row['description'].'<br>';
  }
}
else{
  echo "HH";
}
