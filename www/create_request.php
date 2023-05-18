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
              foreach ($conn->query('SELECT * from servicetypes')->fetch_all(MYSQLI_ASSOC) as $row){
                switch ($row['type']) {
                  case 'connection':
                    $t = 'Подключение';
                    break;
                  case 'disconnection':
                    $t = 'Отключение';
                    break;
                  case 'repair':
                    $t = 'Ремонт';
                    break;
                }
                echo "<option value={$row['id']}> {$t} </option>";
              }
              ?>
            </select>
          </li>
          <li class='form-row'>
            <label> Категория работ: </label>
            <select id='category' name='category'>
              <option selected disabled>-----</option>
              <?
              foreach ($conn->query('SELECT * from servicecategories')->fetch_all(MYSQLI_ASSOC) as $row) {
                switch ($row['category']) {
                  case 'water supply':
                    $c = 'Водоснабжение';
                    break;
                  case 'water disposal':
                      $c = 'Водоотведение';
                      break;
                  case 'power supply':
                    $c = 'Электроснабжение';
                    break;
                  case 'gas supply':
                    $c = 'Газоснабжение';
                    break;
                  case 'heat supply':
                    $c = 'Теплоснабжение';
                    break;
                  case 'solid waste':
                    $c = 'Вывоз мусора';
                    break;
                  case 'elevator':
                    $c = 'Лифт';
                    break;
                }
                  echo "<option value={$row['id']}> {$c} </option>";
                }
              ?>
            </select>
          </li>
          <li class='form-row'>
            <label> Адрес: </label>
            <input id='address' name="address">
          </li>
          <li class='form-row'>
            <label> Опишите заявку: </label>
            <textarea id='description' name="description" cols="50" rows="10" placeholder="Description"></textarea>
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
