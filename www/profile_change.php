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
        <ul class='wrapper' id='ul'>
      <?
        $result = $conn->query("
          select *
          from users u
            left join cities c on (u.city_id=c.id)
            left join streets s on (u.street_id=s.id)
          where u.id={$uid}
        ");
        $info = $result->fetch_assoc();
        $login = $info['login'];
        $facial = $info['facial'];
        $fio = $info['fio'];
        $address = "{$row['city_type']} {$row['city']}, {$row['street_type']} {$row['street']}";
        if($row['house']){
          $address .= ", д.{$row['house']}";
          if($row['flat'])
            $address .= ", кв.{$row['flat']}";
        }
      ?>
      <li class='form-row'>
        <label> Логин </label>
        <label> <? echo $login; ?> </label>
      </li>
      <li class='form-row'>
        <label> Лицевой счет </label>
        <input type='text' oninput='showButton();' rows='1' name='facial' placeholder=<? echo "'{$facial}'"; ?> value=<? echo "'{$facial}'"; ?>> </input>
      </li>
      <li class='form-row'>
        <label> ФИО </label>
        <input type='text' oninput='showButton();' rows='1' name='fio' placeholder=<? echo "'{$fio}'"; ?> value=<? echo "'{$fio}'"; ?>> </input>
      </li>
      <li class='form-row' id='city_li'>
        <label> Выберите нас. пункт: </label>

      </li>
      <ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
