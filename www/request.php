<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

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
    <?
      switch ($_SESSION['user_type']) {
        case 'operator':
          echo "<button class='green' onclick=\"window.location.href='accept.php?id={$id}'\">Принять заявку</button>";
          echo "<button class='red' onclick=\"window.location.href='decline.php?id={$id}'\">Отклонить заявку</button>";
          break;
        case 'foreman':
          echo "<button class='green' onclick=\"window.location.href='complete.php?id={$id}'\">Заявка выполнена</button>";
          break;
      }
    ?>
  </div>
  <? include "footer.php" ?>
</body>
</html>
