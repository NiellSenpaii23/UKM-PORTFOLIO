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

$SQL_list 	= "SELECT * FROM `user` WHERE `id_user` = '$id_user'  ";
$result 	= mysqli_query($con, $SQL_list) ;
$data		= mysqli_fetch_array($result);
$photo		= $data["photo"];
if(!$photo) $photo = "noimage.png";
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
    <div class="w3-content w3-container w3-padding-16 w3-teal w3-center" style="max-width:450px">
		<a href="main.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>My Account</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<div class="w3-center">
			<img src="upload/<?PHP echo $photo; ?>" class="w3-circle" style="width:200px; height:200px">
			<div class="w3-xlarge"><b><?PHP echo $data["firstname"];?></b></div>
		</div>	
		<div class="w3-padding"></div>
		
		<a href="profile.php"><div class="w3-large w3-padding w3-padding-small w3-panel w3-hover-green"><i class="fa fa-fw fa-user fw-lg"></i> Personal Information</div></a>
		<hr style="margin: 0 0 0 0">
		<!--
		<a href="rent.php"><div class="w3-large w3-padding w3-padding-small w3-panel w3-hover-green"><i class="fa fa-fw fa-home fw-lg"></i> Rents</div></a>
		<hr style="margin: 0 0 0 0">
		-->
		<a href="listing.php"><div class="w3-large w3-paddingx w3-padding-small w3-panel w3-hover-green"><i class="fa fa-fw fa-list fw-lg"></i> Listing</div></a>
		<hr style="margin: 0 0 0 0">
		<a href="listing-booking.php"><div class="w3-large w3-paddingx w3-padding-small w3-panel w3-hover-green"><i class="fa fa-fw fa-inbox fw-lg"></i> Booking List</div></a>
		<hr style="margin: 0px 0 0px 0;">
		<a href="help.php"><div class="w3-large w3-paddingx w3-padding-small w3-panel w3-hover-green"><i class="fa fa-fw fa-info-circle fw-lg"></i> Help</div></a>
		<hr style="margin: 0px 0 0px 0;">
		
		<div class="w3-padding-16"></div>
		<div class="w3-center"><a href="sign-out.php" class="w3-button w3-large w3-red w3-round-xlarge">Sign Out</a></div>
	</div>
</div>
<!-- Content End -->



</body>
</html>
