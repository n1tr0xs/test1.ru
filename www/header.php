<?
session_start();
?>
<header>
  <ul class='navbar'>
    <!-- <li class='navbar'><a href=''>  </a></li> -->
    <?
      if(isset($_SESSION['uid']))
        echo "
          <li class='navbar'><a href='my_requests.php?s0=1&s1=1&s2=1&s3=1'> Мои заявки </a></li>
          <li class='navbar'><a href='create_request.php'> Новая заявка </a></li>
        ";
      ?>
    <li class='navbar right'><a href=
    <?
    if(isset($_SESSION['uid']))
      echo "'login.php?act=logout'> Выйти из аккаунта";
    else
      echo "'login.php'> Войти в аккаунт";
    ?> </a></li>
  </ul>
</header>
