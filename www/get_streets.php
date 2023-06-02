<?
include "db_conn.php";

$city = explode(' ', urldecode($_GET['city']));
$city_type = $city[0];
$city_name = $city[1];
echo "select id from cities where name='{$city_name}' and type='{$city_type}'";
$resp = $conn->query("select id from cities where name='{$city_name}' and type='{$city_type}'");
$resp = $resp->fetch_assoc();
$city_id = $resp['id'];
$sql = "select * from streets where city_id={$city_id}";
$res = $conn->query($sql);
$res = $res->fetch_all(MYSQLI_ASSOC);

foreach ($res as $row) {
  $i = $row['id'];
  $n = "{$row['type']} {$row['name']}";
  echo "<option value='{$n}'/>";
}
?>
