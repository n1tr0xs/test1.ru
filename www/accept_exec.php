<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_POST['id'];
$crew_id = $_POST['crew_id'];
$note = $_POST['note'];
$uid = $_SESSION['uid'];

$sql = "
  update requests
  set
    operator_id='{$uid}', 
    status_id='1',
    crew_id='{$crew_id}',
    operator_note='{$note}'
  where id='{$id}'
";
$conn->query($sql);

header("Location: operator_page.php");
?>
