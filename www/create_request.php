<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>

<html>
<head>
  <script type='text/javascript'>
  function validateForm(){

    var el = document.getElementById('type');
    if(el.selectedIndex == 0){
      el.setCustomValidity('Выберите тип услуги');
      return;
    } else{
      el.setCustomValidity('');
    }

    var el = document.getElementById('category');
    if(el.selectedIndex == 0){
      el.setCustomValidity('Выберите категорию услуги');
      return;
    }else{
      el.setCustomValidity('');
    }

    var el = document.getElementById('address');
    if(el.value == ''){
      el.setCustomValidity('Введите адрес');
      return;
    }else{
      el.setCustomValidity('');
    }

    var el = document.getElementById('description');

    if(el.value == ''){
      el.setCustomValidity('Опишите возникшую проблему');
      return;
    }else{
      el.setCustomValidity('');
    }
  }
  </script>
</head>
<body>
  <? include "header.php" ?>
  <div id='content' class='content'>
  <form action='request_creation.php' method="post">
    <label> Тип услуги: </label>
    <select id='type' name='type'>
      <option selected disabled>-----</option>
      <?php
      foreach ($conn->query('SELECT * from servicetypes')->fetch_all(MYSQLI_ASSOC) as $row)
        echo "<option value={$row['id']}> {$row['type']} </option>";
      ?>
    </select>

    <label> Категория работ: </label>
    <select id='category' name='category'>
      <option selected disabled>-----</option>
      <?php
      foreach ($conn->query('SELECT * from servicecategories')->fetch_all(MYSQLI_ASSOC) as $row)
        echo "<option value={$row['id']}> {$row['category']} </option>";
      ?>
    </select>

    <label> Адрес: </label>
    <input id='address' name="address">

    <textarea id='description' name="description" cols="50" rows="10" placeholder="Description"></textarea>
    <button onclick='validateForm();'>Отправить заявку</button>
  </form>
</div>
  <? include "footer.php" ?>
</body>
</html>
