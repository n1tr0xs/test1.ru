<?
include("db_conn.php");
session_start();

$my_data = $conn->query("Select * from {$ALL_USER_TYPES[$_SESSION['user_type']]} where id='{$_SESSION['uid']}'")->fetch_assoc();
$street = $conn->query("Select * from streets where id='{$my_data['street_id']}'")->fetch_assoc();
?>

<html>
<head> </head>
  <body>
  <label>Логин:</label>
  <label><? echo $my_data['login']; ?> </label>
  <br>
  <label>Фамилия Имя Отчество:</label>
  <label> <? echo $my_data['fio']; ?> </label>
  <br>
  <label>Адрес:</label>
  <label> <? echo $street['street_type']. $street['street_name']. ", ". $my_data['house']. ", ". $my_data['flat']; ?> </label>
</body>
</html>
