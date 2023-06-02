<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>
<html>
  <head>
    <link rel='stylesheet' href='css/main.css'>
    <script type="text/javascript">
    function validateForm(){
      var el = document.getElementById('type');
      if(el.value == ''){
        el.setCustomValidity('Выберите тип услуги');
        return;
      } else el.setCustomValidity('');

      var el = document.getElementById('category');
      if(el.value == ''){
        el.setCustomValidity('Выберите категорию услуги');
        return;
      }else el.setCustomValidity('');

      var el = document.getElementById('city');
      if(el.value == ''){
        el.setCustomValidity('Выберите населенный пункт');
        return;
      }else el.setCustomValidity('');

      var el = document.getElementById('street');
      if(el.value == ''){
        el.setCustomValidity('Выберите улицу');
        return;
      }else el.setCustomValidity('');

      var el = document.getElementById('description');
      if(el.value == ''){
        el.setCustomValidity('Опишите возникшую проблему');
        return;
      }else el.setCustomValidity('');
    }

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
    </script>
  </head>
  <body>
    <? include "header.php" ?>
    <div class='content'>
      <? if($_GET['act'] == 'error') echo "<label style='color: red;'> Возникла ошибка, проверьте правильность заполнения полей </label>"; ?>
      <form action='request_creation.php' method="post">
        <ul class='wrapper'>
          <li class='form-row'>
            <label> Тип услуги: </label>
            <input id='type' list="types" name="type" type='text' oninput="loadStreets();">
            <datalist id="types">
              <?
                $res = $conn->query("SELECT * from types");
                $res = $res->fetch_all(MYSQLI_ASSOC);
                foreach ($res as $row)
                    echo "<option value='{$row['name']}'/>";
              ?>
            </datalist>

          </li>
          <li class='form-row'>
            <label> Категория работ: </label>
            <input id='category' list="categories" name="category" type='text' oninput="loadStreets();">
            <datalist id="categories">
              <?
                $res = $conn->query("SELECT * from categories");
                $res = $res->fetch_all(MYSQLI_ASSOC);
                foreach ($res as $row)
                    echo "<option value='{$row['name']}'/>";
              ?>
            </datalist>
          </li>
          <li class='form-row'>
            <label> Выберите нас. пункт </label>
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
            <input id='street' list="streets" name="street" type='text' disabled>
            <datalist id="streets">
            </datalist>
          </li>
          <li class='form-row'>
            <label> Опишите заявку: </label>
            <textarea id='description' name="description" cols="50" rows="10" placeholder="Описание"></textarea>
          </li>
          <li class='form-row'>
            <button onclick='validateForm();'>Отправить заявку</button>
          </li>
      </ul>
      </form>
    </div>
    <? include "footer.php" ?>
   </body>
</html>
