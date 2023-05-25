<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$note = $_POST['note'];

$conn->query("update requests set status_id=3, foreman_note='{$note}' where id='{$id}'");

header('location: foreman_page.php');
?>
