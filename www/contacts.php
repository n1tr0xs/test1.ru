<?
  include "db_conn.php";
  include "funcs.php";
  session_start();
?>

<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> </script>
    <script type='text/javascript'>
      $(document).ready(function(){
        $("li").css('display', 'none'); // hiding contacts
        

      });
    </script>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
      <a href='#unit1' class='show'> Алчевский РЭС </a>
      <ul id='unit1'>
        <li>
          <strong> Алчевский район </strong>
          <br>
          Алчевск
          <br>
          (022)358-923; 072-118-67-00
        </li>
        <li>
          <strong> Перевальский район</strong>
          <br>г.Алчевск, просп.Металлургов д.49
          <br>-
        </li>
      </ul>
    </div>
  </div>
  <? include "footer.php" ?>
</body>
</html>
