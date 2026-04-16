<?PHP
session_start();

include("database.php");
if( !verifyUser($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$id_user	= $_SESSION["id_user"];
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$id_booking	= (isset($_REQUEST['id_booking'])) ? trim($_REQUEST['id_booking']) : '';
$id_property= (isset($_GET['id_property'])) ? trim($_GET['id_property']) : '';
$status		= (isset($_REQUEST['status'])) ? trim($_REQUEST['status']) : 'Pending';

$error = "";
$success = false;

if($act == "Accept")
{
	$SQL_update = " 
		UPDATE `booking` SET 
			`status` = 'Accept' ,
			`is_viewed` = 1
		WHERE `id_booking` =  '$id_booking' ";
	$result = mysqli_query($con, $SQL_update);
	
	$SQL_update = " 
		UPDATE `property` SET 
			`status` = 'Unavailable'
		WHERE `id_property` =  '$id_property' ";
	$result = mysqli_query($con, $SQL_update);
	
	print "<script>self.location='listing-booking.php';</script>";
}

if($act == "Reject")
{
	$SQL_update = " UPDATE `booking` SET `status` = 'Reject' , `is_viewed` =1 WHERE `id_booking` =  '$id_booking' ";
	$result = mysqli_query($con, $SQL_update);
	
	print "<script>self.location='listing-booking.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `booking` WHERE `id_booking` =  '$id_booking' ";
	$result = mysqli_query($con, $SQL_delete);
	
	print "<script>self.location='listing-booking.php';</script>";
}

$count = numRows($con, "SELECT * FROM `booking`,`property`,`user` WHERE booking.id_property = property.id_property AND booking.id_user = user.id_user AND booking.status = '$status'  AND `id_owner` = '$id_user' ");
?>
<!DOCTYPE html>
<html>
<title>Housegoda</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
a:link {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Readex Pro", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  background-image: url("images/back2.jpg");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}

input.cpwd {
  -webkit-text-security: circle;  
  /* circle , square , disk */
}

.w3-merah,.w3-hover-merah:hover{color:#fff!important;background-color:#fe0000!important}

img[alt="www.000webhost.com"]{display:none}
</style>

<body class="">

	
<div class="w3-padding"></div>

<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-teal w3-center" style="max-width:600px">
		<a href="account.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>Booking List</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:600px">		

		<div class="w3-barx">
			<a href="?status=Pending" class="w3-button w3-borderx <?PHP if($status == "Pending") echo "w3-light-gray"; else echo "w3-dark-gray";?> w3-round">Pending</a>
			<a href="?status=Accept" class="w3-button w3-borderx <?PHP if($status == "Accept") echo "w3-light-gray"; else echo "w3-dark-gray";?> w3-round">Accept</a>			
			<a href="?status=Reject" class="w3-button w3-borderx <?PHP if($status == "Reject") echo "w3-light-gray"; else echo "w3-dark-gray";?> w3-round">Reject</a>			
		</div>
		<hr style="margin : 0 0px 0 0px">
		
		<div class="w3-xlarge"><b>Booking Listing <?PHP echo $status;?></b></div>
		You have <?PHP echo $count;?> booking
		<div class="w3-padding"></div>
		
		<?PHP
		$bil = 0;
		$SQL_list = "SELECT * FROM `booking`,`property`,`user` WHERE booking.id_property = property.id_property AND booking.id_user = user.id_user AND booking.status = '$status'  AND `id_owner` = '$id_user' ";
		$result = mysqli_query($con, $SQL_list) ;
		while ( $data	= mysqli_fetch_array($result) )
		{
			$bil++;
			$id_property	= $data["id_property"];
			$id_booking	= $data["id_booking"];
			$photo1		= $data["photo1"];
		?>
		<div class="w3-row w3-card w3-round">
			<div class="w3-col s6 w3-padding">
				<img src="upload/<?PHP echo $photo1;?>" class="w3-image w3-round-large" style="width:150px;height:100px">
				<a href="property-view.php?id_property=<?PHP echo $id_property;?>" class="w3-text-indigo"><div style="line-height: 1.2;"><?PHP echo $data["prop_name"]; ?></div></a>
				<b><?PHP echo $data["price"]; ?></b>
			</div>
			<div class="w3-col s6 w3-padding">
				<div class=" w3-right"><a href="#" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-trash fa-lg"></i></a></div>
				Request By :<br>
				<b><?PHP echo $data["firstname"]; ?></b><br>
				<?PHP echo $data["phone"]; ?>
				<?PHP if(($data["status"] <> "Reject") AND ($data["status"] <> "Pending")) { ?>
				<div class="w3-padding-small"><a href="?act=Accept&id_booking=<?PHP echo $id_booking;?>&id_property=<?PHP echo $id_property;?>" class="w3-tag w3-green w3-round"><i class="fa fa-thumbs-up"></i> Accept</a> &nbsp;
				<a href="?act=Reject&id_booking=<?PHP echo $id_booking;?>" class="w3-tag w3-amber w3-round"><i class="fa fa-thumbs-down"></i> Reject</a></div>
				<?PHP } ?>			
			</div>
		</div>
		<div class="w3-padding-small"></div>

<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Delete Confirmation</b>
			  
			<hr class="w3-clear">
			
			Are you sure to delete this record?
			
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_booking" value="<?PHP echo $id_booking;?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">NO</button>
			
			<button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, DELETE</button>

		</form>
		</div>
	</div>
</div>

		<?PHP } ?>


	</div>
</div>
<!-- Content End -->

</body>
</html>
