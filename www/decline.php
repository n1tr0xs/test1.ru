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
<form action='decline_exec.php' method='post'>
  <input name='id' type='hidden' value=<?echo $id; ?>> </input>
  <textarea name="description" cols="50" rows="10" placeholder="Причина отклонения" required></textarea>
  </select>
  <button type='submit'>Отклонить запрос</button>
</form>
