<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();
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
      <tr>
        <th> Тема заявки </th>
        <th> Дата отправки </th>
        <th> Адрес </th>
        <th> </th>
      </tr>
      <?
        $result = $conn->query("SELECT * from requests where (operator_id is NULL) and (status_id=0) order by creation_date asc");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
          $info = request_info($row);
          $created = date('d-m-Y', strtotime($info['creation_date']));
          echo
          "
          <tr>
            <td>{$info['category']}</td>
            <td>{$created}</td>
            <td>{$info['address']}</td>
            <td><a href='request.php?id={$info['id']}'> Перейти к заявке </a> </td>
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
