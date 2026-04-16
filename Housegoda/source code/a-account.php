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
$id_admin	= $_SESSION["id_admin"];

$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$username	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$success = "";

if($act == "edit")
{	
	$SQL_update = " 
	UPDATE
		`admin`
	SET
		`username` = '$username',
		`password` = '$password'
	WHERE
		id_admin = $id_admin
	";
										
	$result = mysqli_query($con, $SQL_update);
	
	$success = "Successfully Updated";
	
	//print "<script>self.location='profile.php';</script>";
}

$SQL_list 	= "SELECT * FROM `admin` ";
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
		<a href="a-main.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>My Account</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<form action="" method="post" >			
			
			<?PHP if($success) { echo "<div class='w3-green w3-padding'>$success</div>"; } ?>
			
			<div class="w3-section" >
				Username
				<input class="w3-input w3-border w3-round-large" type="text" name="username" value="<?PHP echo $data["username"];?>" placeholder="First Name" required>
			</div>
			
			<div class="w3-section" >
				Password
				<input class="w3-input w3-border w3-round-large" type="password" name="password" value="<?PHP echo $data["password"];?>" placeholder="Second Name" required>
			</div>
			
			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="act" type="hidden" value="edit">
				<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>SAVE CHANGES</b></button>
			</div>
		</form>
		
		<hr>
		
		<div class="w3-padding-16"></div>
		
		
		
	</div>
</div>
<!-- Content End -->

<div class="w3-bottom" id="contact">
    <div class="w3-content w3-container w3-padding-32" style="max-width:450px">
		<div class="w3-center"><a href="a-sign-out.php" class="w3-button w3-large w3-red w3-round-xlarge">Sign Out</a></div>
		<div class="w3-padding-16"></div>
	</div>
</div>

</body>
</html>
