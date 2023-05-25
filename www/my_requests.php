<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
  <script type="text/javascript" src="js/scripts.js"> </script>
</head>
<body>
  <? include "header.php" ?>
  <br>
  <div id='content' class='content'>
    <fieldset>
      <form method='get' action='my_requests.php' name='status'>
        <table>
          <tr>
            <td> <legend> Показывать заявки со статусом: </legend> </td>
          </tr>
          <tr>
            <td> <input class='status checkbox' name='s0' type='checkbox' value='1' name='s0' <? if(isset($_GET['s0'])) echo "checked"; ?>>Отправлена</input> </td>
            <td> <input class='status checkbox' name='s1' type='checkbox' value='1' name='s1' <? if(isset($_GET['s1'])) echo "checked"; ?>>Рассмотрена</input> </td>
            <td> <input class='status checkbox' name='s2' type='checkbox' value='1' name='s2' <? if(isset($_GET['s2'])) echo "checked"; ?>>Выполнена</input> </td>
            <td> <input class='status checkbox' name='s3' type='checkbox' value='1' name='s3' <? if(isset($_GET['s3'])) echo "checked"; ?>>Отклонена</input> </td>
          </tr>
          <tr>
            <td> <button type='button' onclick="selectAll('status');"> Выделить всё </button> </td>
            <td> <button type='button' onclick="unselectAll('status');"> Снять выделение </button> </td>
            <td></td>
            <td> <button type='submit'> Применить фильтр </button> </td>
          </tr>
        </table>
      </form>
    </fieldset>
    <table>
      <tr>
        <th> Тема заявки </th>
        <th> Дата отправки </th>
        <th> Номер заявки </th>
        <th> Статус заявки </th>
        <th> Адрес </th>
      </tr>
    <?
      $uid = $_SESSION['uid'];
      $statuses = array();
      for($i=0; $i<4; ++$i)
        if($_GET["s{$i}"] == "1")
          array_push($statuses, "{$i}");
      if(isset($statuses[0])){
        $statuses = '('. join(',', $statuses). ')';
      } else {
        $statuses = "(-1)";
      }
      $result = $conn->query("SELECT * from requests where user_id={$uid} and status_id IN {$statuses} order by creation_date desc");
      if(mysqli_num_rows($result)){
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as $row) {
          $info = request_info($row);
          $created = date('d-m-Y', strtotime($info['creation_date']));
          echo
          "
          <tr>
            <td>{$info['category']}</td>
            <td>{$created}</td>
            <td>{$info['id']}</td>
            <td>{$info['status']}</td>
            <td>{$info['address']}</td>
          </tr>
          ";
        }
      }
    ?>
    <tr> </tr>
  </table>
  </div>
  <? include "footer.php" ?>
</body>
</html>
