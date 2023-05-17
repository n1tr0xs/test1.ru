<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$result = $conn->query("SELECT * from requests where (operator_id is NULL) and (status=0)");
$rows = $result->fetch_all(MYSQLI_ASSOC);
if($rows){
  foreach ($rows as $row) {
    print_request_for_operator($row);
  }
}
else{
  echo "Нет новых заявок от пользователей.";
}
