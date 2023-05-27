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
  // foreach ($row as $key => $value) {
  //   echo "{$key} -> {$value} <br>";
  // }
  $category = $row['category'];
  $status = $row['status'];
  $address = "{$row['city_type']} {$row['city']}, {$row['street_type']} {$row['street']}";

  if($row['house'])
    $address .= ", д.{$row['house']}";
  if($row['flat'])
    $address .= ", кв.{$row['flat']}";

  return array(
    "id"=>$row['id'],
    "category"=>$category,
    "status"=>$status,
    "address"=>$address,
    "description"=>$row['description'],
    "creation_date"=>$row['creation_date'],
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
