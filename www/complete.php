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
        $result = $conn->query("
          SELECT r.id, r.user_id, r.description, r.phone, r.status_id, r.creation_date, r.closing_date, ct.type city_type, ct.name city , st.type street_type, st.name street, r.house, r.flat, s.name status, r.category_id category_id, cg.name category
          from requests r
            left join statuses s on(r.status_id=s.id)
            left join categories cg on (r.category_id=cg.id)
            left join cities ct on (r.city_id=ct.id)
            left join streets st on (r.street_id=st.id)
          where
            r.id='{$id}'
          order by
            creation_date desc
        ");
        $result = $result->fetch_assoc();
        $info = request_info($result);
      ?>
      <tr>
        <td> Категория </td>
        <td> <? echo $info['category']; ?></td>
      </tr>
      <tr>
        <td> Описание от пользователя </td>
        <td> <? echo $info['description']; ?> </td>
      </tr>
      <?
        if ($info['operator_note'])
          echo "
            <tr>
              <td> Заметка оператора </td>
              <td> {$info['operator_note']} </td>
            </tr>
          ";
      ?>
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
      <? echo "<input type='hidden' name='id' value='{$id}'/>"; ?>
      <ul class='wrapper'>
        <li class='form-row'>
          <label> Ваша заметка </label>
          <textarea name="note" cols="50" rows="5" placeholder="заметка"></textarea>
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
