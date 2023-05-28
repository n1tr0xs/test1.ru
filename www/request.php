<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_GET['id'];
$uid = $_SESSION['uid'];
if($_SESSION['user_type'] == 'operator'){
  $resp = $conn->query("select operator_id from requests where id={$id}");
  $resp = $resp->fetch_assoc();
  if($resp['operator_id']!=NULL){
    if($resp['operator_id'] != $uid){
      header("location: operator_page.php?msg=considering");
    }
  } else {
    $conn->query("update requests set operator_id={$uid} where id={$id}");
  }
}
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
          SELECT r.id, r.user_id, r.description, r.creation_date, r.closing_date, ct.type city_type, ct.name city , st.type street_type, st.name street, r.house, r.flat, s.name status, r.category_id category_id, cg.name category
          from requests r
            left join statuses s on(r.status_id=s.id)
            left join categories cg on (r.category_id=cg.id)
            left join cities ct on (r.city_id=ct.id)
            left join streets st on (r.street_id=st.id)
          where
            (r.id={$id})
          order by
            creation_date desc
        ");
        // $result = $conn->query("select * from requests r left join statuses s on(r.status_id=s.id) where id={$id}");
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
      <tr>
        <td> Ваше описание </td>
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
        if($info['foreman_note'])
        echo "
          <tr>
            <td> Заметка рабочей бригады </td>
            <td> {$info['foreman_note']} </td>
          </tr>
        ";
        if($info['closing_date'])
        echo "
          <tr>
            <td> Дата закрытия заявки </td>
            <td> {$info['closing_date']} </td>
          </tr>
        ";
      ?>
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
