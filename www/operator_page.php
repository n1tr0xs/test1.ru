<?
include 'db_conn.php';
include 'funcs.php';
session_start();

$result = $conn->query("SELECT * from requests where (operator_id is NULL) and (status=0)");
$rows = $result->fetch_all(MYSQLI_ASSOC);
if($rows){
  foreach ($rows as $row) {
    echo request_info($row);
  }
}
else{
  echo "No requests.";
}
