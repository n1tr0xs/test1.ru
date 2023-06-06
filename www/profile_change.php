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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> </script>
    <script src="js/main.js"> </script>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <form action="profile_exec.php" method="post">
      <ul class='wrapper'>
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
          $fio = $info['fio'];
          $address = $info['address'];
        ?>
        <li class='form-row'>
          <label> Логин </label>
          <label> <? echo $login; ?> </label>
        </li>
        <li class='form-row'>
          <label> ФИО </label>
          <input type='text' oninput='showButton();' name='fio' placeholder=<? echo "'{$fio}'"; ?> value=<? echo "'{$fio}'"; ?> />
        </li>
        <li class='form-row'>
          <label> Населенный пункт </label>
          <input id='city' type='text' name="city" list="cities" oninput="loadStreets();" />
          <datalist id="cities">
          <?
            $res = $conn->query("select * from cities");
            $res = $res->fetch_all(MYSQLI_ASSOC);
            foreach ($res as $row)
            echo "<option value='{$row['type']} {$row['name']}' />";
          ?>
          </datalist>
        </li>
          <li class='form-row'>
          <label> Улица </label>
          <input id='street' type='text' name="street" list="streets" oninput="enableHouse();" placeholder="сначала выберите населенный пункт" disabled />
          <datalist id="streets">
          </datalist>
        </li>
          <li class='form-row'>
          <label> Дом </label>
          <input id='house' type='text' name='house' oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); enableFlat();" placeholder="сначала выберите улицу" disabled />
        </li>
          <li class='form-row'>
          <label> Квартира </label>
          <input id='flat' type='text' name='flat' oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"  placeholder="сначала введите номер дома"  disabled />
        </li>
        <li class='form-row'>
          <button type='submit'> Подтвердить </button>
        </li>
        <li class='form-row' style="visibility: hidden">
          <label> label </label>
          <textarea cols="50" disabled></textarea>
        </li>
      <ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
