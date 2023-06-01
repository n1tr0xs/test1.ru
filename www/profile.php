<?
  include "db_conn.php";
  include "funcs.php";
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
      <?
        $resp = $conn->query("
          select u.login login, u.fio fio, u.facial facial, CONCAT(c.type, \" \", c.name) city, CONCAT(s.type, \" \", s.name) street, u.house house, u.flat flat
          from users u
            left join cities c on (u.city_id=c.id)
            left join streets s on (u.street_id=s.id)
        ");
        $info = $resp->fetch_assoc();
      ?>
      <tr>
        <td> Логин </td>
        <td> <? echo $info['login']; ?></td>
      </tr>
      <tr>
        <td> ФИО </td>
        <td> <? echo $info['fio']; ?></td>
      </tr>
      <tr>
        <td> Лицевой счет </td>
        <td> <? echo $info['facial']; ?></td>
      </tr>
      <tr>
        <td> Адрес </td>
        <td>
          <?
          $address = "{$info['city']}, {$info['street']}";

          if($info['house']){
            $address .= ", д.{$info['house']}";
            if($info['flat'])
              $address .= ", кв.{$info['flat']}";
          }
          echo $address;
          ?>
        </td>
      </tr>
      <tr>
        <td colspan=2>
          <button type='button' onclick='window.location.href="profile_change.php"'> Изменить данные </button>
        </td>
      </tr>
    </table>
  </div>
  <? include "footer.php" ?>
</body>
</html>
