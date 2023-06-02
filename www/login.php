<?php
// $_SESSION['user'], $_SESSION['uid'], $_SESSION['user_type']
include "db_conn.php";
include "funcs.php";
session_start();

if (isset($_SESSION['user_type'])){
  switch ($_SESSION['user_type']) {
    case 'user':
      header("location: /my_requests.php?s0=1&s1=1&s2=1&s3=1");
      break;
    case 'operator':
      header("location: /operator_page.php");
      break;
    case 'foreman':
      header("location: /foreman_page.php");
      break;
    }
}

if (isset($_GET) && isset($_GET['act']) && ($_GET['act'] == 'logout')){
  session_unset();
  header("location: login.php");
}

if (isset($_POST) && isset($_POST['uname']) && isset($_POST['password'])) {

  $uname = $_POST['uname'];
  $pass = $_POST['password'];
  $logged = false;
  foreach ($ALL_USER_TYPES as $t=>$db) {
    $sql = "SELECT id, login, password from {$db} where login='{$uname}' and password='{$pass}'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result)){
      $logged = true;
      $r = $result->fetch_assoc();
      $_SESSION['user'] = $uname;
      $_SESSION['uid'] = $r['id'];
      $_SESSION['user_type'] = $t;
      switch ($_SESSION['user_type']) {
        case 'user':
          header("location: /my_requests.php?s0=1&s1=1&s2=1&s3=1");
          break;
        case 'operator':
          header("location: /operator_page.php");
          break;
        case 'foreman':
          header("location: /foreman_page.php");
          break;
        }
      break;
    }
  }
  if(!$logged) header("Location: /login.php?act=error");
}
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <form action="login.php" method="post">
    <ul class='wrapper'>
      <li class='form-row'>
        <? if (isset($_GET['act']) && $_GET['act'] == 'error') echo "<label style='text-align: center;'> Неверный логин или пароль! </label>"; ?>
        <? if (isset($_GET['act']) && $_GET['act'] == 'reg') echo "<label style='text-align: center;'> Вы успешно зарегестрированы! </label>"; ?>
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
        <button type="submit">Войти</button>
        <button type='button' onclick='window.location.href="registration.php"'> Регистрация </button>
      </li>
    </ul>
  </form>
  <? include "footer.php" ?>
</body>
</html>
