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

            <?
              $resp = $conn->query("select id, name from statuses");
              $resp = $resp->fetch_all(MYSQLI_ASSOC);
              foreach ($resp as $row) {
                $status_id = $row['id'];
                $status_name = $row['name'];
                echo "<td> <input class='status checkbox' name='s{$status_id}' type='checkbox' value='1' name='s0'";
                if(isset($_GET["s{$status_id}"]))
                  echo "checked";
                echo "> {$status_name}</input> </td>";
              }
            ?>
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
        <th> Статус заявки </th>
        <th> Адрес </th>
        <th> </th>
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
      $result = $conn->query("
        SELECT r.id, r.user_id, r.description, r.creation_date, r.closing_date, ct.type city_type, ct.name city , st.type street_type, st.name street, r.house, r.flat, s.name status, r.category_id category_id, cg.name category
        from requests r
          left join statuses s on(r.status_id=s.id)
          left join categories cg on (r.category_id=cg.id)
          left join cities ct on (r.city_id=ct.id)
          left join streets st on (r.street_id=st.id)
        where
          (r.user_id={$uid}) and
          (r.status_id IN {$statuses})
        order by
          creation_date desc
      ");
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      foreach ($rows as $row) {
        $info = request_info($row);
        $created = date('d-m-Y', strtotime($info['creation_date']));
        echo
        "
        <tr>
          <td>{$info['category']}</td>
          <td>{$created}</td>
          <td>{$info['status']}</td>
          <td>{$info['address']}</td>
          <td><a href='request.php?id=${info['id']}'> Подробнее </a></td>
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
