<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
  <script type='text/javascript' src='js/scripts.js'> </script>
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
