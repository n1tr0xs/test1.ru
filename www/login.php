<?php
// $_SESSION['user'], $_SESSION['uid'], $_SESSION['user_type']
include "db_conn.php";
include "funcs.php";
session_start();

if (isset($_GET['act']) && ($_GET['act'] == 'logout')){
  session_unset();
}

if (isset($_POST['uname']) && isset($_POST['password'])) {

  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);

  foreach ($ALL_USER_TYPES as $t=>$db) {
    $result = $conn->query("SELECT id, login, password from {$db} where login='{$uname}' and password='{$pass}'");

    if(mysqli_num_rows($result)){
      $r = $result->fetch_assoc();
      $_SESSION['user'] = $uname;
      $_SESSION['uid'] = $r['id'];
      $_SESSION['user_type'] = $t;
      header("Location: /index.php");
      break;
    }
  }
}
?>

<html>
<head>
</head>
<body>
  <form action="login.php" method="post">
    <label>Логин</label>
    <input type="text" name="uname" placeholder="User Name" required><br>
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Password" required><br>
    <? if (isset($_GET['act']) && $_GET['act'] == 'error') echo "Неверный логин или пароль<br>"; ?>
    <button type="submit">Войти</button>
  </form>
</body>
</html>
