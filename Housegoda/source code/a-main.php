<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$pending 	= numRows($con, "SELECT * FROM `property` WHERE `status` = 'Pending' ");
$approved 	= numRows($con, "SELECT * FROM `property` WHERE `status` = 'Approved' ");
$reject 	= numRows($con, "SELECT * FROM `property` WHERE `status` = 'Reject' ");
$user 		= numRows($con, "SELECT * FROM `user` ");
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

<!-- menu top -->
<div class="w3-top " id="contact">
    <div class="w3-content w3-containerx w3-white" style="max-width:600px">
	<div class="w3-marginx w3-padding w3-center" >
		<a href="a-main.php"><img src="images/logo-small.jpg" class="w3-image"></a>
    </div>
	

	</div>
</div>

<div class="w3-padding-32"></div>

<!-- content -->	
<div class="w3-containerx " id="contact">
    <div class="w3-content w3-container " style="max-width:600px">	
		
		<div class="w3-xlarge w3-center"><b>Welcome, Admin</b></div>
		
		<div class="w3-padding w3-center">
			<a href="a-pending.php">
			<div class="w3-amber w3-hover-teal w3-round-xlarge">
				<div class="w3-row w3-padding-small">
				<span class="w3-left"><i class="fa fa-fw fa-hourglass fa-lg"></i></span>
				</div>
				<div class="w3-xlarge"><?PHP echo $pending;?></div>
				Pending Request
			</div>
			</a>
		</div>

		<div class="w3-padding w3-center">
			<a href="a-listing.php?status=Approved">
			<div class="w3-green w3-hover-teal w3-round-xlarge">
				<div class="w3-row w3-padding-small">
				<span class="w3-left"><i class="fa fa-fw fa-check fa-lg"></i></span>
				</div>
				<div class="w3-xlarge"><?PHP echo $approved;?></div>
				Approved Properties
			</div>
			</a>
		</div>
		
		<div class="w3-padding w3-center">
			<a href="a-listing.php?status=Reject">
			<div class="w3-red w3-hover-teal w3-round-xlarge">
				<div class="w3-row w3-padding-small">
				<span class="w3-left"><i class="fa fa-fw fa-times fa-lg"></i></span>
				</div>
				<div class="w3-xlarge"><?PHP echo $reject;?></div>
				Reject Properties
			</div>
			</a>
		</div>
		
		<div class="w3-padding w3-center">
			<a href="a-user.php">
			<div class="w3-teal w3-hover-green w3-round-xlarge">
				<div class="w3-row w3-padding-small">
				<span class="w3-left"><i class="fa fa-fw fa-users fa-lg"></i></span>
				</div>
				<div class="w3-xlarge"><?PHP echo $user;?></div>
				All User
			</div>
			</a>
		</div>
		
	
	</div>
</div>

<div class="w3-padding-48"></div>



<!-- content end -->

<!-- Menu Footer -->
<div class="w3-containerx w3-bottom" id="contact">
    <div class="w3-content w3-containerx w3-padding-small w3-teal w3-center" style="max-width:600px">

	<div class="w3-row w3-small">
		<div class="w3-col s3">
			<a href="a-main.php" class="w3-button w3-hover-green w3-padding-small w3-text-lime">
				<img src="images/ico-home.jpg" class="w3-circle"><br>
				HOME
			</a>
		</div>
		<div class="w3-col s3">
			<a href="a-pending.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-rent.jpg" class="w3-circle"><br>
				PENDING
			</a>
		</div>
		<div class="w3-col s3">
			<a href="a-listing.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-rent.jpg" class="w3-circle"><br>
				LISTING
			</a>
		</div>
		<div class="w3-col s3">
			<a href="a-account.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-acc.jpg" class="w3-circle"><br>
				ACCOUNT
			</a>
		</div>
	</div>
	
	</div>
</div>

</body>
</html>
