<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$crew_id = $_POST['crew_id'];
$uid = $_SESSION['uid'];

$conn->query("update requests set operator_id='{$uid}', status='1', crew_id='{$crew}' where id='{$id}'");

header("Location: operator_page.php");
