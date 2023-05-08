<?php
session_start();
include 'db_conn.php';
?>

<form action='request_creation.php' method="post">
  <label>Service type:</label>
  <select name='type'>
    <?php
    foreach ($conn->query('SELECT * from servicetypes')->fetch_all(MYSQLI_ASSOC) as $row)
      echo "<option value={$row['id']}> {$row['type']} </option>";
    ?>
  </select>
  <br>
  <label>Service category:</label>
  <select name='category'>
    <?php
    foreach ($conn->query('SELECT * from servicecategories')->fetch_all(MYSQLI_ASSOC) as $row)
      echo "<option value={$row['id']}> {$row['category']} </option>";
    ?>
  </select>
  <br>
  <label>Address:</label>
  <input name="address"/>
  <br>
  <textarea name="description" cols="50" rows="10" placeholder="Description" required></textarea>
  <br>
  <button type='submit'> Создать заявку </button>
</form>
