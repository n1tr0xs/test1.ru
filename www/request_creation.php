<?php
session_start();
include 'db_conn.php';

if (empty($_POST)){
  header("location: index.php");
  exit();
}

$type = $_POST['type'];
$resp = $conn->query("select id from types where name='{$type}'")->fetch_assoc();
$type_id = $resp['id'];

$category = $_POST['category'];
$resp = $conn->query("select id from categories where name='{$type}'")->fetch_assoc();
$category_id = $resp['id'];

list($city_type, $city_name) = explode(' ', $_POST['city']);
$resp = $conn->query("select id from cities where name='{$city_name}' and type='{$city_type}'")->fetch_assoc();
$city_id = $resp['id'];

$street = explode(' ', $_POST['street']);
list($street_type, $street_name) = explode(' ', $_POST['street']);
$resp = $conn->query("select id from streets where name='{$street_name}' and type='{$street_type}' and city_id='{$city_id}'")->fetch_assoc();
$street_id = $resp['id'];

$user_id = $_SESSION['uid'];
$description = $_POST['description'];

$date = date("Y-m-d");

$sql = "
  INSERT INTO `hcs`.`requests`
  (`id`, `user_id`, `type_id`, `category_id`, `description`, `city_id`, `street_id`, `house`, `flat`, `operator_id`, `operator_note`, `crew_id`, `foreman_note`, `creation_date`, `closing_date`, `status_id`)
  VALUES
  (NULL, '{$user_id}', '{$type_id}', '{$category_id}', '{$description}', '{$city_id}', '{$street_id}', NULL, NULL, NULL, NULL, NULL, NULL, '{$date}', '0', '0')"
;
$resp = $conn->query($sql);
$id = mysqli_insert_id($conn);

if(!$resp)
  header("location: create_request.php?act=error");
else
  header("location: request.php?id={$id}");
