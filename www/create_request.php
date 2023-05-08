<?php
session_start();
include 'db_conn.php';
include 'funcs.php';
auth_redirect();
?>

<form action='request_creation.php' method="post">
  <label>������ ��� �����:</label>
  <select name='type'>
    <?php
    foreach ($conn->query('SELECT * from servicetypes')->fetch_all(MYSQLI_ASSOC) as $row)
      echo "<option value={$row['id']}> {$row['type']} </option>";
    ?>
  </select>
  <br>
  <label>�������� ��������� �����:</label>
  <select name='category'>
    <?php
    foreach ($conn->query('SELECT * from servicecategories')->fetch_all(MYSQLI_ASSOC) as $row)
      echo "<option value={$row['id']}> {$row['category']} </option>";
    ?>
  </select>
  <br>
  <label>������� �����:</label>
  <input name="address" required/>
  <br>
  <textarea name="description" cols="50" rows="10" placeholder="Description" required></textarea>
  <br>
  <button type='submit'>������� ������</button>
</form>
