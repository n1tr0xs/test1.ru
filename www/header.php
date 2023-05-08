<?
session_start();
include 'funcs.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <a href='login.php' target='content'> Main page </a>
    <br>
    <? if(is_auth()) echo "<a href='login.php?act=logout' target='content'> Logout </a>"; ?>
  </body>
</html>
