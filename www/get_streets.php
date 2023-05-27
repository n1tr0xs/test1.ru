<?
include "db_conn.php";

$city_id = $_GET['city_id'];
$sql = "select * from streets where city_id={$city_id}";
$res = $conn->query($sql);
$res = $res->fetch_all(MYSQLI_ASSOC);

echo "<option selected disabled>-----</option>";
foreach ($res as $row) {
  $i = $row['id'];
  $n = "{$row['type']} {$row['name']}";
  echo "<option value='{$i}'> {$n} </option>";
}
?>
