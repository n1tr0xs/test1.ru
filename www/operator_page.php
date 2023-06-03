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
    <?
      if($_GET['msg'] == 'considering')
        echo "<label style='color: red; text-align: center; width: 100%'> Заявка уже рассматривается </label>";
    ?>
    <table>
      <tr>
        <th> Тема заявки </th>
        <th> Дата отправки </th>
        <th> Адрес </th>
        <th> </th>
      </tr>
      <?
        $result = $conn->query("
          SELECT r.id, r.user_id, r.description, r.phone,  r.status_id, r.creation_date, r.closing_date, CONCAT(ct.type, \" \", ct.name) city, CONCAT(st.type, \" \", st.name) street, r.house, r.flat, s.name status, r.category_id category_id, cg.name category
          from requests r
            left join statuses s on(r.status_id=s.id)
            left join categories cg on (r.category_id=cg.id)
            left join cities ct on (r.city_id=ct.id)
            left join streets st on (r.street_id=st.id)
          where
            (operator_id is NULL) and
            (status_id=0)
          order by
            creation_date desc
        ");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
          $info = request_info($row);
          $created = date('d-m-Y', strtotime($info['creation_date']));
          echo "
            <tr>
              <td> {$info['category']} </td>
              <td> {$created} </td>
              <td> {$info['address']} </td>
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
