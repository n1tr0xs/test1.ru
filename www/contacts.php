<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> </script>
    <script type='text/javascript'>
      $(document).ready(function(){
        $("a.show").on('click', function(){
          var href = $(this).attr('href');
          var now_disp = $("ul"+href).css('display');
          if(now_disp == 'none'){
            $("ul"+href).css('display', 'block');
          } else if (now_disp == 'block') {
            $("ul"+href).css('display', 'none');
          }
          );
        });
      });
    </script>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <div>
      <h3> Луганские электрические сети</h3>
      <div>
        <a href='#unit1' class='show'> Алчевский РЭС </a>
        <ul id='unit1' class='unit'>
          <li>
            <strong> Алчевский район </strong>
            <br> Алчевск
            <br> (022)358-923; 072-118-67-00
          </li>
          <li class='unit'>
            <strong> Перевальский район</strong>
            <br> г.Алчевск, просп.Металлургов д.49
            <br> -
          </li>
        </ul>
      </div>
      <div>
        <a href='#unit2' class='show'> Антрацитовский РЭС </a>
        <ul id='unit2' class='unit'>
          <li>
            <strong> Антрацитовский район электрических сетей </strong>
            <br> г.Антрацит, ул.Глинки д.16
            <br> (06431)2-85-85
          </li>
          <li class='unit'>
            <strong> Антрацитовский р-он </strong>
            <br> г.Антрацит, ул.Глинки д.16
            <br> -
          </li>
        </ul>
      </div>
    </div>
    <div>
      <h3> ГУП ЛНР РСК</h3>
      <div>
        <a href='#unit3' class='show'> Беловодский РЭС, Марковский участок, Меловской участок </a>
        <ul id='unit3' class='unit'>
          <li>
            <strong> Беловодский РЭС </strong>
            <br> 92800, пгт Беловодск, ул. Гуньяна, д.61
            <br> (06466) 2-00-05; 0800300074
          </li>
          <li>
            <strong> Марковский участок</strong>
            <br> 92400, пгт. Марковка, ул. Задорожного, д.29
            <br> (06464) 9-25-08
          </li>
          <li>
            <strong> Меловской участок </strong>
            <br> 92500, пгт.Мелове, ул.Дружбы народов, д.185
            <br> (06465) 2-12-49
          </li>
        </ul>
      </div>
      <div>
        <a href='#unit4' class='show'> Лисичанский РЭС </a>
        <ul id='unit4' class='unit'>
          <li>
            <strong> Попаснянский РЭС </strong>
            <br> 93300, г.Попасная, ул. Спортивная, д.11
            <br> 3-35-36
          </li>
        </ul>
      </div>
    </div>
  </div>
  <? include "footer.php" ?>
</body>
</html>
