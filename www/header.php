<?
session_start();
?>
<header>
  <ul class='navbar'>
    <!-- <li class='navbar'><a href=''>  </a></li> -->
    <li class='navbar'><a href='my_requests.php'> Мои заявки </a></li>
    <li class='navbar'><a href='create_request.php'> Новая заявка </a></li>
    <li class='navbar right'><a href=
    <?
    if(isset($_SESSION))
      echo "'login.php?act=logout'> Выйти из аккаунта";
    else
      echo "'login.php'> Войти в аккаунт";
    ?> </a></li>
  </ul>
</header>
