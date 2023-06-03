<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();


$uid = $_SESSION['uid'];
$facial = $_POST['facial'];
$fio = $_POST['fio'];

list($city_type, $city_name) = explode(' ', $_POST['city']);
$resp = $conn->query("select id from cities where name='{$city_name}' and type='{$city_type}'")->fetch_assoc();
$city_id = $resp['id'];

$street = explode(' ', $_POST['street']);
list($street_type, $street_name) = explode(' ', $_POST['street']);
$resp = $conn->query("select id from streets where name='{$street_name}' and type='{$street_type}' and city_id='{$city_id}'")->fetch_assoc();
$street_id = $resp['id'];

$house = $_POST['house'];
$flat = $_POST['flat'];

$default = $conn->query("select * from users where id={$uid}")->fetch_assoc();
if(!$facial) $facial = $default['facial'];
if(!$fio) $fio = $default['fio'];

if(!$flat and $house)
  $flat = 'NULL';
if(!$city) $city = $default['city'];
if(!$street) $street = $default['street'];
if(!$house) $house = $default['house'];

$sql = "
  update users
  set
    facial='{$facial}',
    fio='{$fio}',
    city_id={$city_id},
    street_id={$street_id},
    house={$house},
    flat={$flat}
  where id={$uid}
";
$resp = $conn->query($sql);

if(!$resp)
  echo $sql;
else
  header("location: profile.php");
