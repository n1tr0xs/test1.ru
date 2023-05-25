<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$desc = $_POST['description'];
$uid = $_SESSION['uid'];

$conn->query("update requests set operator_id='{$uid}', status_id='2', description='{$desc}' where id='{$id}'");

header("Location: operator_page.php");
