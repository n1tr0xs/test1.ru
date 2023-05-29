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

    function showButton(){
      if(document.getElementById('button_li'))
        return;

      btn_li = document.createElement('li');
      btn_li.className = 'form-row';
      btn_li.id = 'button_li';
      btn_li.innerHTML = "<button type='submit'> Изменить данные </button>";
      document.getElementById('ul').appendChild(btn_li);
    }

    function loadStreets(){
      var street_li = document.createElement("li");
      street_li.className = 'form-row';
      street_li.id = 'street_li';
      street_li.innerHTML = "<label> Выберите улицу </label> <select name='street' id='street' oninput='showHouseFlat();'> <option selected disabled> загрузка.. </option> </select>";

      var parent = document.getElementById('ul');
      var next_sib = document.getElementById('city_li').nextSibling;
      if(next_sib)
        parent.insertBefore(street_li, next_sib);
      else
        parent.appendChild(street_li);

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
           document.getElementById("street").innerHTML = this.responseText;
           street_li.style.visibility = "visible";
      };
      var selected = document.getElementById('city').value;
      xhttp.open('get', 'get_streets.php?city_id='+selected, true);
      xhttp.send();
    }

    function numValidate(){
      this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');
    }

    function showHouseFlat(){

      var house_li = document.createElement("li");
      house_li.className = 'form-row';
      house_li.id = 'house_li';
      house_li.innerHTML = "<label> Дом </label> <input type='text' name='house' oninput=\"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); showButton();\"> </input>";

      var parent = document.getElementById('ul');
      var next_sib = document.getElementById('street_li').nextSibling;
      if(next_sib)
        parent.insertBefore(house_li, next_sib);
      else
        parent.appendChild(house_li);

      var flat_li = document.createElement("li");
      flat_li.className = 'form-row';
      flat_li.id = 'flat_li';
      flat_li.innerHTML = "<label> Квартира </label> <input type='text' name='flat' oninput=\"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');\"> </input>";

      var parent = document.getElementById('ul');
      var next_sib = document.getElementById('house_li').nextSibling;
      if(next_sib)
        parent.insertBefore(flat_li, next_sib);
      else
        parent.appendChild(flat_li);
    }

    </script>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <form action='profile_exec.php' method='post'>
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
        <select id='city' name='city' oninput="loadStreets();">
          <option selected disabled>-----</option>
          <?
            $res = $conn->query("select * from cities");
            $res = $res->fetch_all(MYSQLI_ASSOC);
            foreach ($res as $row) {
              echo "<option value={$row['id']}> {$row['type']} {$row['name']} </option> ";
          }
          ?>
        </select>
      </li>
      <ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
