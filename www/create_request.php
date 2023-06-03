<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>
<html>
  <head>
    <link rel='stylesheet' href='css/main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> </script>
    <script src="js/main.js"> </script>
    <script type='text/javascript'>
    function addSpaces(initial){
      initial.replace("/([0-9]{3})/","\1 ");
      initial.replace("/[0-9]{3} ([0-9]{3})/","\1 ");
      return initial;
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
            <label class='required'> Тип услуги </label>
            <input id='type' type='text' name="type" list="types">
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
            <label class='required'> Категория работ </label>
            <input id='category' type='text' name="category" list="categories" />
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
            <label class='required'> Населенный пункт </label>
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
            <label class='required'> Улица </label>
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
            <input id='flat' type='text' name='flat' oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="сначала введите номер дома" disabled />
          </li>
          <li class='form-row'>
            <label class='required'> Номер телефона </label>
            <input id='phone' type='tel' name='phone' pattern="\+[0-9]{1,2}\s*[0-9]{3}\s*[0-9]{4}" onchange="this.value=addSpaces(this.value);" placeholder="+7 959 123 1234"/>
          </li>
          <li class='form-row'>
            <label class='required'> Описание заявки </label>
            <textarea id='description' name="description" cols="50" rows="10" placeholder="Описание"></textarea>
          </li>
          <li class='form-row'>
            <button onclick='validateForm();'> Отправить заявку </button>
          </li>
      </ul>
      </form>
    </div>
    <? include "footer.php" ?>
   </body>
</html>
