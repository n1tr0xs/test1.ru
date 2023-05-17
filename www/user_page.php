<?
session_start();
include 'funcs.php';
auth_redirect();
?>

<html>
<header>
  <link rel='stylesheet' href='css/main.css'>
</header>
<body>
  <? include "header.php" ?>
  <div id='content' class='content'>
    <a href="create_request.php"> Создать заявку </a>
    <a href="my_requests.php"> Мои заявки </a>
    <a href="login.php?act=logout"> Выйти из аккаунта </a>
  </div>
  <? include "footer.php" ?>
</body>
</html>
