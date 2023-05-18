<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div id='content' class='content'>
    <table>
      <tr>
        <th> Тема заявки </th>
        <th> Дата отправки </th>
        <th> Номер заявки </th>
        <th> Статус заявки </th>
        <th> Адрес дома </th>
      </tr>

    <?
    $uid = $_SESSION['uid'];
    $result = $conn->query("SELECT * from requests where user_id=$uid");
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
    ?>
    <tr> </tr>
  </table>
  </div>
  <? include "footer.php" ?>
</body>
</html>
