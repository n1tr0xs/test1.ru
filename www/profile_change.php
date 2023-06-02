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
    <script type="text/javascript">
    function loadStreets(){
      datalist = document.getElementById("streets");
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
           datalist.innerHTML = this.responseText;
           document.getElementById("street").disabled = false;
      };
      var selected = document.getElementById('city').value;
      xhttp.open('get', 'get_streets.php?city='+encodeURIComponent(selected), true);
      xhttp.send();
    }

    function enableHouse(){
      document.getElementById('house').disabled = false;
    }
    function enableFlat(){
      document.getElementById('flat').disabled = false;
    }
    </script>
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
        <input type='text' oninput='showButton();' rows='1' name='facial' placeholder=<? echo "'{$facial}'"; ?> value=<? echo "'{$facial}'"; ?>/>
      </li>
      <li class='form-row'>
        <label> ФИО </label>
        <input type='text' oninput='showButton();' rows='1' name='fio' placeholder=<? echo "'{$fio}'"; ?> value=<? echo "'{$fio}'"; ?> />
      </li>
      <li class='form-row'>
        <label> Выберите нас. пункт: </label>
        <input id='city' list="cities" name="city" type='text' oninput="loadStreets();">
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
        <label> Выберите улицу </label>
        <input id='street' list="streets" name="street" type='text' disabled oninput='enableHouse();'>
        <datalist id="streets">
        </datalist>
      </li>
      <li class='form-row'>
        <label> Дом </label>
        <input id='house' type='text' name='house' oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); enableFlat();" disabled/>
      </li>
      <li class='form-row'>
        <label> Квартира </label>
        <input id='flat' type='text' name='flat' oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" disabled/>
      </li>
      <li class='form-row'>
        <button type='submit'> Изменить данные </button>
      </li>
      <ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
