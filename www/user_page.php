<?
session_start();
include 'funcs.php';
auth_redirect();
?>

<html>
<header>
</header>
<body>

<?  echo $_SESSION['uid']; ?>
  <a href="profile.php"> ��� ������� </a>
  <br>
  <a href="create_request.php"> ����� ������ </a>
  <br>
  <a href="my_requests.php"> ��� ������ </a>
  <br>
  <a href="login.php?act=logout"> ����� �� �������� </a>
</body>
</html>
