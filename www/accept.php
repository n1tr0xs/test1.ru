<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_GET['id'];
?>
<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <table>
      <?
        $result = $conn->query("select * from requests where id={$id}");
        $result = $result->fetch_assoc();
        $info = request_info($result);
      ?>
      <tr>
        <td> Категория </td>
        <td> <? echo $info['category']; ?></td>
      </tr>
      <tr>
        <td> Описание </td>
        <td> <? echo $info['description']; ?> </td>
      </tr>
      <tr>
        <td> Адрес </td>
        <td> <? echo $info['address']; ?> </td>
      </tr>
      <tr>
        <td> Дата создания </td>
        <td> <? echo date('d-m-Y', strtotime($info['creation_date'])); ?> </td>
      </tr>
    </table>

    <form action='accept_exec.php' method='post'>
      <ul class='wrapper'>
        <input name='id' type='hidden' value=<?echo $id; ?>> </input>
        <li class='form-row'>
          <label> Выберите команду </label>
          <select name='crew_id'>
            <?
              $result = $conn->query("select * from requests where id={$id}");
              $result = $result->fetch_assoc();
              $info = request_info($result);
              $category_id = $result['category_id'];
              foreach ($conn->query("SELECT * from crews where category_id={$category}")->fetch_all(MYSQLI_ASSOC) as $row)
                echo "<option value={$row['id']}> {$row['number']} </option>";
            ?>
          </select>
        </li>
        <li class='form-row'>
          <textarea name="note" cols="50" rows="10" placeholder="Описание"></textarea>
        </li>
        <li class='form-row'>
          <button type='submit'>Принять заявку</button>
        </li>
      </ul>
    </form>
</div>
<? include "footer.php" ?>
</body>
</html>
