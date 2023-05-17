<div class='header' id='header'>
  <a href='login.php'> Main page </a>
  
  <? if(is_auth()) echo "<a href='login.php?act=logout'> Logout </a>"; ?>
</div>
