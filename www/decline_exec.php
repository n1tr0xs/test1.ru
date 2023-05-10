<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$desc = $_POST['description'];

$conn->query("update requests set `status`='2', `description`='{$desc}' where `id`='{$id}'");

header("Location: operator_page.php");
