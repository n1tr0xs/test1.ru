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
$city_id = $_POST['city'];
$street_id = $_POST['street'];
$date = date("Y-m-d");

$sql = "
  INSERT INTO `hcs`.`requests`
  (`id`, `user_id`, `type_id`, `category_id`, `description`, `city_id`, `street_id`, `house`, `flat`, `operator_id`, `operator_note`, `crew_id`, `foreman_note`, `creation_date`, `closing_date`, `status_id`)
  VALUES
  (NULL, '{$user_id}', '{$type}', '{$category}', '{$description}', '{$city_id}', '{$street_id}', NULL, NULL, NULL, NULL, NULL, NULL, '{$date}', '0000-00-00 00:00:00', '0')"
;

$conn->query($sql);

header('location: my_requests.php?s0=1&s1=1&s2=1&s3=1');
