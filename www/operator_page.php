<?
include 'db_conn.php';
session_start();

$response = conn->query("SELECT * from requests where operator_id not NULL");
$rows = response->fetch_all(MYSQLI_ASSOC);
if($rows){
  foreach ($row as $rows) {
    echo "{$row['type_id']} {$row['category_id']} {$row['status']} {$row['description']} <br>";
  }
}
