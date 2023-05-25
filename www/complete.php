<?
include 'db_conn.php';
include 'funcs.php';

session_start();
if($_SESSION['user_type'] != 'foreman')
  header('login.php');

$id = $_GET['id'];
$uid = $_SESSION['uid'];
?>

<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <table>
      <?
        $result = $conn->query("select * from requests where id={$id}");
        $result = $result->fetch_assoc();
        $info = request_info($result);
      ?>
      <tr>
        <td> Категория </td>
        <td> <? echo $info['category']; ?></td>
      </tr>
      <tr>
        <td> Описание </td>
        <td> <? echo $info['description']; ?> </td>
      </tr>
      <tr>
        <td> Адрес </td>
        <td> <? echo $info['address']; ?> </td>
      </tr>
      <tr>
        <td> Дата создания </td>
        <td> <? echo date('d-m-Y', strtotime($info['creation_date'])); ?> </td>
      </tr>
    </table>
    <form action='complete_exec.php' method='post'>
      <? echo "<input type='hidden' name='id' value='{$id}'> </input>"; ?>
      <ul class='wrapper'>
        <li class='form-row'>
          <label> Описание </label>
          <textarea name="note" cols="50" rows="5" placeholder="Описание"></textarea>
        </li>
        <li class='form-row'>
          <button type='submit' class='green'> Подтвердить выполнение заявки </button>
        </li>
      </ul>
    </form>

  </div>
  <? include "footer.php" ?>
</body>
</html>
