<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();

$id = $_GET['id'];
?>
<html>
<head>
    <link rel='stylesheet' href='css/main.css'>
</head>
<body>
  <? include "header.php" ?>
  <div class='content'>
    <table>
      <?
        $result = $conn->query("
          SELECT r.id, r.user_id, r.description, r.category_id, r.status_id, r.creation_date, r.closing_date, ct.type city_type, ct.name city , st.type street_type, st.name street, r.house, r.flat, s.name status, r.category_id category_id, cg.name category
          from requests r
            left join statuses s on(r.status_id=s.id)
            left join categories cg on (r.category_id=cg.id)
            left join cities ct on (r.city_id=ct.id)
            left join streets st on (r.street_id=st.id)
          where
            (r.id={$id})
          order by
            creation_date desc
          ");
        // $result = $conn->query("select * from requests r left join statuses s on(r.status_id=s.id) where id={$id}");
        $result = $result->fetch_assoc();
        $info = request_info($result);
      ?>
      <tr>
        <td> Категория </td>
        <td> <? echo $info['category']; ?></td>
      </tr>
      <tr>
        <td> Описание </td>
        <td> <? echo $info['description']; ?> </td>
      </tr>
      <tr>
        <td> Адрес </td>
        <td> <? echo $info['address']; ?> </td>
      </tr>
      <tr>
        <td> Дата создания </td>
        <td> <? echo date('d-m-Y', strtotime($info['creation_date'])); ?> </td>
      </tr>
    </table>

    <form action='accept_exec.php' method='post'>
      <ul class='wrapper'>
        <input name='id' type='hidden' value=<?echo $id; ?>/>
        <li class='form-row'>
          <label> Выберите команду </label>
          <select name='crew_id'>
            <?
              $category_id = $info['category_id'];
              $crews = $conn->query("
                SELECT c.id id, c.number number
                from crews c
                  join crew_category cc on (c.id=cc.crew_id)
                where cc.category_id={$category_id}
              ");
              $crews = $crews->fetch_all(MYSQLI_ASSOC);
              foreach ($crews as $row)
                echo "<option value={$row['id']}> {$row['number']} </option>";
            ?>
          </select>
        </li>
        <li class='form-row'>
          <textarea name="note" cols="50" rows="10" placeholder="Описание"></textarea>
        </li>
        <li class='form-row'>
          <button type='submit'>Принять заявку</button>
        </li>
      </ul>
    </form>

    <table>
      <caption> Адреса принятых заявок у каждой бригады </caption>
      <tr>
        <?
          foreach ($crews as $row)
            echo "<th> {$row['number']} </th>";
        ?>
      </tr>
      <?
        $crew_requests = array();
        $max_len = -1;
        foreach ($crews as $row) {
          $crew_id = $row['id'];
          $crew_requests[$crew_id] = array();
          $rr = $conn->query("
            select c.type city_type, c.name city, s.type street_type, s.name street
            from requests r
              left join cities c on (r.city_id=c.id)
              left join streets s on (r.street_id=s.id)
            where
              status_id=1
              and crew_id={$crew_id}
          ");
          $rr = $rr->fetch_all(MYSQLI_ASSOC);
          foreach ($rr as $row) {
            $rinfo = request_info($row);
            array_push($crew_requests[$crew_id], $rinfo['address']);
          }
          $max_len = max(sizeof($crew_requests[$crew_id], 0), $max_len);
        }

        for($i=0; $i<$max_len; ++$i){
          echo "<tr>";
          foreach ($crew_requests as $key => $value) {
            echo "<td> {$value[$i]} </td>";
          }
          echo "</tr>";
        }
      ?>
    </table>
</div>
<? include "footer.php" ?>
</body>
</html>
