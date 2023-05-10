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
?>
<form action='accept_exec.php' method='post'>
  <input name='id' type='hidden' value=<?echo $id; ?>> </input>
  <select name='crew'>
    <?php
    foreach ($conn->query('SELECT * from crews')->fetch_all(MYSQLI_ASSOC) as $row)
      echo "<option value={$row['id']}> {$row['name']} </option>";
    ?>
  </select>
  <button type='submit'>Направить запрос команде</button>
</form>
