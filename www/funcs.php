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

  return array($type, $category, $status, $row['description']);
}

function print_request_for_user($r){
  $r_info = request_info($r);

  echo "<div class='request_for_user'>";
  echo "$r_info[0] $r_info[1] $r_info[2] $r_info[3]";
  echo "</div>";
}
?>
