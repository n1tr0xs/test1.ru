<?
include 'db_conn.php';
include 'funcs.php';

session_start();
auth_redirect();


$uid = $_SESSION['uid'];
$facial = $_POST['facial'];
$fio = $_POST['fio'];
$city = $_POST['city'];
$street = $_POST['street'];
$house = $_POST['house'];
$flat = $_POST['flat'];

$resp = $conn->query("select * from users where id={$uid}");
$resp = $resp->fetch_assoc();
if(!$facial) $facial = $resp['facial'];
if(!$fio) $fio = $resp['fio'];

if(!$flat and $house)
  $flat = 'NULL';
if(!$city) $city = $resp['city'];
if(!$street) $street = $resp['street'];
if(!$house) $house = $resp['house'];


$conn->query("
  update users
  set
    facial='{$facial}',
    fio='{$fio}',
    city_id={$city},
    street_id={$street},
    house={$house},
    flat={$flat}
  where id={$uid}
");

header("location: profile.php");
