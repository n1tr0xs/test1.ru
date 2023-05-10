<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$crew = $_POST['crew'];

$conn->query("update requests set `status`='1', `crew_id`='{$crew}' where `id`='{$id}'");

header("Location: operator_page.php");
