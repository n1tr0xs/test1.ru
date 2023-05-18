<?php
// $_SESSION['user'], $_SESSION['uid'], $_SESSION['user_type']
include "db_conn.php";
include "funcs.php";
session_start();

if (isset($_SESSION['user_type'])){
  switch ($_SESSION['user_type']) {
    case 'user':
      header("location: /my_requests.php");
      break;
    case 'operator':
      header("location: /operator_page.php");
      break;
    case 'crewmember':
      header("location: /crewmember_page.php");
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

  foreach ($ALL_USER_TYPES as $t=>$db) {
    $result = $conn->query("SELECT id, login, password from {$db} where login='{$uname}' and password='{$pass}'");
    if(mysqli_num_rows($result)){
    $r = $result->fetch_assoc();
    $_SESSION['user'] = $uname;
    $_SESSION['uid'] = $r['id'];
    $_SESSION['user_type'] = $t;
    switch ($_SESSION['user_type']) {
      case 'user':
        header("location: /my_requests.php");
        break;
      case 'operator':
        header("location: /operator_page.php");
        break;
      case 'crewmember':
        header("location: /crewmember_page.php");
        break;
      }
    break;
    }
    else{
      header("Location: /login.php?act=error");
    }
  }
}
?>

<html>
<head>
  <link rel='stylesheet' href='css/main.css'>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
</head>
<body>
  <form action="login.php" method="post">
    <label>Логин</label>
    <input type="text" name="uname" placeholder="User Name" required>
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Password" required>
    <? if (isset($_GET['act']) && $_GET['act'] == 'error') echo "Неверный логин или пароль!"; ?>
    <button type="submit">Войти</button>
  </form>
</body>
</html>
