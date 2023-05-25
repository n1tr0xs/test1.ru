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
  $arr = array("Водоснабжение", "Водотведение", "Электроснабжение", "Газоснабжение", "Теплоснабжение", "Вывоз мусора", "Лифт");
  $category = $arr[$row['category_id']];

  $arr = array("Отправлена", "Рассмотрена", "Выполнена", "Отклонена");
  $status = $arr[$row['status_id']];

  return array(
    "category"=>$category,
    "status"=>$status,
    "description"=>$row['description'],
    "creation_date"=>$row['creation_date'],
    "id"=>$row['id'],
  );
}

function print_request_for_user($r){
  $r_info = request_info($r);
  $date = date('d-m-Y',strtotime($r_info[4]));

  echo "<div class='request_for_user'>";
  echo "$r_info[0] $r_info[1] $r_info[2] $r_info[3] : $date";
  echo "</div>";
}

function print_request_for_operator($r){
  $r_info = request_info($r);
  $date = date('d-m-Y',strtotime($r_info[4]));
  $id = $r_info[5];

  echo "<div class='request_for_user'>";
  echo "$r_info[0] $r_info[1] $r_info[2] $r_info[3] : $date";
  echo "<button onclick=\"window.location.href='request.php?id={$id}'\"></button>";
  echo "</div>";
}

function print_request($r){

}
?>
