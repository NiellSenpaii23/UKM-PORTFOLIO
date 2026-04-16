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

$firstname	= (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$secondname	= (isset($_POST['secondname'])) ? trim($_POST['secondname']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$firstname	=	mysqli_real_escape_string($con, $firstname);
$secondname	=	mysqli_real_escape_string($con, $secondname);

$success = "";

if($act == "edit")
{	
	$SQL_update = " 
	UPDATE
		`user`
	SET
		`firstname` = '$firstname',
		`secondname` = '$secondname',
		`phone` = '$phone',
		`email` = '$email',
		`password` = '$password'
	WHERE
		id_user = $id_user
	";
										
	$result = mysqli_query($con, $SQL_update);
	
	if(isset($_FILES['photo'])){		 
		  $file_name = $_FILES['photo']['name'];
		  $file_size = $_FILES['photo']['size'];
		  $file_tmp = $_FILES['photo']['tmp_name'];
		  $file_type = $_FILES['photo']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$file_name);
			 
			$query = "UPDATE `user` SET `photo`='$file_name' WHERE `id_user` = '$id_user'";			
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}
	
	$success = "Successfully Updated";
	
	//print "<script>self.location='profile.php';</script>";
}

if($act == "photo_del")
{
	$dat	= mysqli_fetch_array(mysqli_query($con, "SELECT `photo` FROM `user` WHERE `id_user`= '$id_user'"));
	unlink("upload/" .$dat['photo']);
	$rst_d 	= mysqli_query( $con, "UPDATE `user` SET `photo`='' WHERE `id_user` = '$id_user' " );
	print "<script>self.location='profile.php';</script>";
}

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
		<a href="account.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>Personal Info</b>
		</span>
	</div>
</div>

<div class="w3-padding"></div>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "profile.php"); }
?>	
<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<div class="w3-padding-16"></div>
		
		<form action="" method="post" enctype = "multipart/form-data" >			
			
			<?PHP if($success) { echo "<div class='w3-green w3-padding'>$success</div>"; } ?>
			  
			<div class="w3-section w3-center" >
				<img src="upload/<?PHP echo $photo; ?>" class="w3-circle w3-image" alt="image" style="width:100%;max-width:200px">
				<?PHP if($data["photo"] <>"") { ?>
				<br>
				<a class="w3-tag w3-red w3-round w3-small" href="?act=photo_del"><small>Remove</small></a>
				<?PHP }  ?>
			</div>
			
			<div class="w3-section" >
				<?PHP if($data["photo"] =="") { ?>
				<div class="custom-file">
					<input type="file" class="w3-input w3-border w3-round-large" name="photo" id="photo" accept=".jpeg, .jpg,.png,.gif">
					<small>  only JPEG, JPG, PNG or GIF allowed </small>
				</div>
				<?PHP } ?>
			</div>
			
			<div class="w3-section" >
				First Name
				<input class="w3-input w3-border w3-round-large" type="text" name="firstname" value="<?PHP echo $data["firstname"];?>" placeholder="First Name" required>
			</div>
			
			<div class="w3-section" >
				Second Name
				<input class="w3-input w3-border w3-round-large" type="text" name="secondname" value="<?PHP echo $data["secondname"];?>" placeholder="Second Name" required>
			</div>

			<div class="w3-section" >
				Email Address
				<input class="w3-input w3-border w3-round-large" type="email" name="email" value="<?PHP echo $data["email"];?>" placeholder="Email Address" required>
			</div>
			
			<div class="w3-section" >
				Phone Number
				<input class="w3-input w3-border w3-round-large" type="text" name="phone" value="<?PHP echo $data["phone"];?>" placeholder="Phone Number" required>
			</div>

			<div class="w3-section">
				Password
				<input class="w3-input w3-border w3-round-large cpwdx" type="password" name="password" id="password" value="<?PHP echo $data["password"];?>" placeholder="Password" required>
				<div class="w3-center w3-text-gray">Password must at least be 6 characters</div>
			</div>
			
			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="act" type="hidden" value="edit">
				<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>SAVE CHANGES</b></button>
			</div>
		</form>
				
	</div>
</div>
<!-- Content End -->



</body>
</html>
