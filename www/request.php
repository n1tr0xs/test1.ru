<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_GET['id'];
$result = $conn->query("select * from requests where id={$id}");
$result = $result->fetch_assoc();

$info = request_info($result);
$id = $info[5];
foreach ($info as $key => $value) {
  echo "{$key} - {$value} <br>";
}
echo "<button onclick=\"window.location.href='accept.php?id={$id}'\">Принять запрос</button> <button onclick=\"window.location.href='decline.php?id={$id}'\">Отклонить запрос</button>";
