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
$id_property= (isset($_REQUEST['id_property'])) ? trim($_REQUEST['id_property']) : '';	
$id_owner	= (isset($_POST['id_owner'])) ? trim($_POST['id_owner']) : '';	
$purpose	= (isset($_POST['purpose'])) ? trim($_POST['purpose']) : '';	

$success = "";

if($act == "book")
{	
	$SQL_insert = " 
	INSERT INTO `booking`(`id_booking`, `id_property`, `id_owner`, `id_user`, `purpose`, `status`, `is_viewed`, `created_date`) 
	VALUES (NULL, '$id_property', '$id_owner', '$id_user', '$purpose', 'Pending', 0, NOW())
	";
										
	$result = mysqli_query($con, $SQL_insert);
	
	$success = "Successfully Booked";
	
	//print "<script>self.location='profile.php';</script>";
}

$SQL_prop 	= "SELECT * FROM `property` WHERE `id_property` = '$id_property'  ";
$rst_prop 	= mysqli_query($con, $SQL_prop) ;
$dat_prop	= mysqli_fetch_array($rst_prop);


$SQL_list 	= "SELECT * FROM `user` WHERE `id_user` = '$id_user'  ";
$result 	= mysqli_query($con, $SQL_list) ;
$data		= mysqli_fetch_array($result);
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
		<a href="property.php?id_property=<?PHP echo $id_property;?>" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>BOOK</b>
		</span>
	</div>
</div>

<div class="w3-padding"></div>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "main.php"); }
?>	
<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<div class="w3-padding-16"></div>
		
		<form action="" method="post" enctype = "multipart/form-data" >			
			
			<?PHP if($success) { echo "<div class='w3-green w3-padding'>$success</div>"; } ?>
			
			<div class="w3-padding w3-padding-16 w3-border w3-round">
			<div class="w3-large"><b><?PHP echo $dat_prop["prop_name"]; ?></b></div>
			<div class=""><?PHP echo $dat_prop["address"]; ?></div>
			</div>
			
			<div class="w3-section" >
				Name
				<input disabled class="w3-input w3-border w3-round-large" type="text" name="firstname" value="<?PHP echo $data["firstname"];?><?PHP echo $data["secondname"];?>" placeholder="First Name" required>
			</div>

			<div class="w3-section" >
				Email Address
				<input disabled class="w3-input w3-border w3-round-large" type="email" name="email" value="<?PHP echo $data["email"];?>" placeholder="Email Address" required>
			</div>
			
			<div class="w3-section" >
				Phone Number
				<input disabled class="w3-input w3-border w3-round-large" type="text" name="phone" value="<?PHP echo $data["phone"];?>" placeholder="Phone Number" required>
			</div>
			
			<div class="w3-section" >
				What is the promary purpose for your booking?<br>
				<input class="w3-radio" type="radio" name="purpose" value="Student" checked>
				<label>Student</label>
				&nbsp;
				<input class="w3-radio" type="radio" name="purpose" value="Business" >
				<label>Business</label>
			</div>
			
			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="id_property" type="hidden" value="<?PHP echo $id_property;?>">
				<input name="id_owner" type="hidden" value="<?PHP echo $dat_prop["id_user"]; ?>">
				<input name="act" type="hidden" value="book">
				<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>BOOK</b></button>
			</div>
		</form>
				
	</div>
</div>
<!-- Content End -->



</body>
</html>
