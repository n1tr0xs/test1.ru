<?php
session_start();
include 'db_conn.php';

$uid = $_SESSION['uid'];

$result = $conn->query("SELECT * from requests where user_id=$uid");
$rows = $result->fetch_all(MYSQLI_ASSOC);
if($rows){
  foreach ($rows as $row) {
    echo "{$row['type_id']} {$row['category_id']} {$row['status']} {$row['description']} <br>";
  }
}
else{
  echo "No requests";
}
