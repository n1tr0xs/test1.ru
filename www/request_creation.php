<?php
session_start();
include 'db_conn.php';

if (empty($_POST)){
  die("Error");
}

$r = $conn->query('SELECT max(id) from requests');
$r = $r->fetch_array();
$id = $r['max(id)'] + 1;

$conn->query(
  "INSERT INTO `requests`
  (`id` , `type_id` , `category_id` , `user_id` , `operator_id` , `crew_id` , `status` , `description`)
  VALUES
  (".$id.", ".$_POST['type']." , ".$_POST['category']." , ".$_SESSION['uid']." , NULL, NULL, '0', ".$_POST['description'].");"
);

header('location: user_page.php');
