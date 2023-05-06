<?

function validate($data){
  return htmlspecialchars(stripslashes(trim($data)));
};

function request_info($row){
  //echo "{$row['type_id']} {$row['category_id']} {$row['status']} {$row['description']} <br>";
  $arr = array("connection", "disconnection", "repair");
  $type = $arr[$row['type_id']];

  $arr = array("water supply", "water disposal", "power supply", "gas supply", "heat supply", "solid waste");
  $category = $arr[$row['category_id']];

  $arr = array("not considered", "assigned to team", "completed");
  $status = $arr[$row['status']];

  return array("type"=>$type, "category"=>$category, "status"=>$status, "description"=>$row['description']);
}

?>
