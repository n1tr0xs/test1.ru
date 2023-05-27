<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>
<html>
  <head>
    <link rel='stylesheet' href='css/main.css'>
    <script type='text/javascript' src='js/scripts.js'></script>
    <script type="text/javascript">
    function loadStreets(){
      document.getElementById("street").innerHTML = "";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
           document.getElementById("street").innerHTML = this.responseText;
      };
      var selected = document.getElementById('city').value;
      xhttp.open('get', 'get_streets.php?city_id='+selected, true);
      xhttp.send();
    }
    </script>
  </head>
  <body>
    <? include "header.php" ?>
    <div class='content'>
      <form action='request_creation.php' method="post">
        <ul class='wrapper'>
          <li class='form-row'>
            <label> Тип услуги: </label>
            <select id='type' name='type'>
              <option selected disabled>-----</option>
              <?
                $res = $conn->query("SELECT * from types");
                $res = $res->fetch_all(MYSQLI_ASSOC);
                foreach ($res as $row)
                  echo "<option value={$row['id']}> {$row['name']} </option>";
              ?>
            </select>
          </li>
          <li class='form-row'>
            <label> Категория работ: </label>
            <select id='category' name='category'>
              <option selected disabled>-----</option>
              <?
                $res = $conn->query("SELECT * from categories");
                $res = $res->fetch_all(MYSQLI_ASSOC);
                foreach ($res as $row) {
                    echo "<option value={$row['id']}> {$row['name']} </option>";
                  }
              ?>
            </select>
          </li>
          <li class='form-row'>
            <label> Выберите нас. пункт: </label>
            <select id='city' name='city' onchange="loadStreets();">
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
          <li class='form-row'>
            <label> Выберите улицу </label>
            <select name='street' id='street'>
            </select>
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
