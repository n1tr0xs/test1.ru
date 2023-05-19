<?
include 'db_conn.php';
session_start();


if(isset($_POST['uname']) && isset($_POST['password'])){
  $login = $_POST['uname'];
  $password = $_POST['password'];
  $r = $conn->query("select login from users where login='{$login}'");
  if(mysqli_num_rows($r)){
    header("location: registration.php?act=error");
  } else{
    $r = $conn->query('SELECT max(id) from users');
    $r = $r->fetch_array();
    $id = $r['max(id)'] + 1;
    $conn->query("insert into users VALUES ({$id}, '{$login}', '{$password}', NULL, NULL, NULL, NULL, NULL)");
    header("location: login.php?act=reg");
  }
}
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <form method="post" action="registration.php">
      <ul class='wrapper'>
        <li class='form-row'>
          <? if (isset($_GET['act']) && $_GET['act'] == 'error') echo "<label>Такой логин уже зарегестрирован!</label>"; ?>
        </li>
        <li class='form-row'>
          <label>Логин</label>
          <input type="text" name="uname" placeholder="Логин" required>
        </li>
        <li class='form-row'>
          <label>Пароль</label>
          <input type="password" name="password" placeholder="Пароль" required>
        </li>
        <li class='form-row'>
          <button type="submit">Зарегестрироваться</button>
        </li>
      </ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
