<?PHP
session_start();
include("database.php");

$id_booking	= (isset($_GET['id_booking'])) ? trim($_GET['id_booking']) : '';
$id_property= (isset($_GET['id_property'])) ? trim($_GET['id_property']) : '';

$SQL_update = "UPDATE `booking` SET `is_viewed` = '1' WHERE `id_booking` =  '$id_booking' ";
$result = mysqli_query($con, $SQL_update);

print "<script>self.location='property.php?id_property=$id_property';</script>";
?>