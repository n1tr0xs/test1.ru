<?
  include "db_conn.php";
  include "funcs.php";
  session_start();
  auth_redirect();
  $uid = $_SESSION['uid'];
?>

<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <form action='profile_exec.php' method='post'>
        <ul class='wrapper'>
      <?
        $result = $conn->query("select * from users where id={$uid}");
        $info = $result->fetch_assoc();
        $login = $info['login'];
        $facial = $info['facial'];
        $fio = $info['fio'];
      ?>
      <li class='form-row'>
        <label> Логин </label>
        <label> <? echo $login; ?> </label>
      </li>
      <li class='form-row'>
        <label> Лицевой счет </label>
        <input type='text' rows='1' name='facial' placeholder=<? echo "'{$facial}'"; ?>> </input>
      </li>
      <li class='form-row'>
        <label> ФИО </label>
        <input type='text' rows='1' name='fio' placeholder=<? echo "'{$fio}'"; ?> </input>
      </li>
      <li class='form-row'>
        <label> Адрес </label>
        <input name='address'> </input>
      </li>
      <li class='form-row'>
        <button type='submit'> Изменить данные </button>
      </li>
      <ul>
    </form>
  </div>
  <? include "footer.php" ?>
</body>
</html>
