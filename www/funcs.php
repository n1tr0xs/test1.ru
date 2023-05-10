<?

function validate($data){
  return htmlspecialchars(stripslashes(trim($data)));
};

function is_auth(){
  session_start();
  return isset($_SESSION['uid']);
}

function auth_redirect(){
  if(!is_auth()){
    header("location: index.php");
    exit();
  }
}

function request_info($row){
  //echo "{$row['type_id']} {$row['category_id']} {$row['status']} {$row['description']} <br>";
  $arr = array("Подключение", "Отключение", "Ремонт");
  $type = $arr[$row['type_id']];

  $arr = array("Водоснабжение", "Водоотведение", "Электроэнергия", "Газоснабжение", "Теплоснабжение", "Мусоровывоз");
  $category = $arr[$row['category_id']];

  $arr = array("Не расммотрена", "Принята", "Назначена на", "Отклонена");
  $status = $arr[$row['status']];

  return array($type, $category, $status, $row['description'], $row['creation_date'], $row['id']);
}

function print_request_for_user($r){
  $r_info = request_info($r);
  $date = date('d-m-Y',strtotime($r_info[4]));

  echo "<div class='request_for_user'>";
  echo "$r_info[0] $r_info[1] $r_info[2] $r_info[3] Создана: $date";
  echo "</div>";
}

function print_request_for_operator($r){
  $r_info = request_info($r);
  $date = date('d-m-Y',strtotime($r_info[4]));
  $id = $r_info[5];

  echo "<div class='request_for_user'>";
  echo "$r_info[0] $r_info[1] $r_info[2] $r_info[3] Создана: $date";
  echo "<button onclick=\"window.location.href='request.php?id={$id}'\">Обработать заявку</button>";
  echo "</div>";
}

function print_request($r){
  
}
?>
