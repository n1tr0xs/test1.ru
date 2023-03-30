<?php
session_start();
include 'db_conn.php';
?>

<form action='request_creation.php' method="post">
  <label>Service type:</label>
  <select name='type'>
    <?php
    $result = $conn->query('SELECT * from servicetypes');
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row)
      echo "<option value=\"". $row['id']. "\"> ". $row['type']. " </option>";
    ?>
  </select>

  <label>Service category:</label>
  <select name='category'>
    <?php
    $result = $conn->query('SELECT * from servicecategories');
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row)
      echo "<option value=\"". $row['id']. "\"> ". $row['category']. " </option>";
    ?>
  </select>
  <br>
  <textarea name="description" cols="50" rows="10" placeholder="Description"></textarea>
  <br>
  <button type='submit'> Create </button>
</form>
