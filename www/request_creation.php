<?php
session_start();
include 'db_conn.php';

if (empty($_POST)){
  header("location: index.php");
  exit();
}

$type = $_POST['type'];
$category = $_POST['category'];
$user_id = $_SESSION['uid'];
$description = $_POST['description'];
$date = date("Y-m-d");

$conn->query("
  INSERT INTO `requests`
  (`id`, `type_id`, `category_id`, `user_id`, `creation_date`, `closing_date`, `operator_id`, `crew_id`, `description`, `status_id`)
  VALUES
  ('', '$type', '$category', '$user_id', '$date', NULL, NULL, NULL, '$description', '0')
");

header('location: my_requests.php?s0=1&s1=1&s2=1&s3=1');
