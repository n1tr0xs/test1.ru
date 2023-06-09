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
  $status_colors = array('white', 'blue', 'red', 'green');
  $status = $row['status'];

  $address = "";
  if($row['city']){
    $address .= "{$row['city']}";
    if($row['street']){
      $address .= ", {$row['street']}";
      if($row['house']){
        $address .= ", д.{$row['house']}";
        if($row['flat'])
          $address .= ", кв.{$row['flat']}";
      }
    }
  }

  return array(
    "id"=>$row['id'],
    "category"=>$category,
    "status_id"=>$row['status_id'],
    "status_color"=>$status_colors[$row['status_id']],
    "status"=>$status,
    "address"=>$address,
    "phone"=>$row['phone'],
    "operator_note"=>$row['operator_note'],
    "foreman_note"=>$row['foreman_note'],
    "description"=>$row['description'],
    "creation_date"=>$row['creation_date'],
    "closing_date"=>$row['closing_date'],
    "category_id"=>$row['category_id'],
  );
}
?>
