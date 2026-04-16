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
$id_user	= (isset($_REQUEST['id_user'])) ? trim($_REQUEST['id_user']) : '';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$firstname	= (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$secondname	= (isset($_POST['secondname'])) ? trim($_POST['secondname']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$firstname	=	mysqli_real_escape_string($con, $firstname);
$secondname	=	mysqli_real_escape_string($con, $secondname);

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
		WHERE `id_user` =  '$id_user'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	$success = "Successfully Update";
	print "<script>self.location='a-user.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `user` WHERE `id_user` =  '$id_user' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='a-user.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<title>Housegoda</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
a:link {
  text-decoration: none;
}

body,h1, h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

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


</style>

<body class="w3-light-grey">


<div class="" >

<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-teal w3-center" style="max-width:450px">
		<a href="a-main.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>All User</b>
		</span>
	</div>
</div>
	
<div class="w3-padding-48"></div>


<?PHP
$bil = 0;
$SQL_list = "SELECT * FROM `user` ";
$result = mysqli_query($con, $SQL_list) ;
while ( $data	= mysqli_fetch_array($result) )
{
	$bil++;
	$id_user= $data["id_user"];
	$photo		= $data["photo"];
	if(!$photo) $photo = "noimage.png";
?>			
<div class="w3-container w3-padding-12" id="contact">
    <div class="w3-content w3-container w3-card w3-white w3-round-large w3-padding-16" style="max-width:400px">
			
			<div class="w3-row">
				<div class="w3-center"><img src="upload/<?PHP echo $photo; ?>" class="w3-round-xlarge w3-image" alt="image" style="width:100px;"></div>
				<div class="w3-col s5">First Name</div>
				<div class="w3-col s7"><?PHP echo $data["firstname"] ;?></div>
			</div>
			<div class="w3-row">
				<div class="w3-col s5">Second Name</div>
				<div class="w3-col s7"><?PHP echo $data["secondname"] ;?></div>
			</div>
			<div class="w3-row">	
				<div class="w3-col s5">Phone</div>
				<div class="w3-col s7"><?PHP echo $data["phone"] ;?></div>
			</div>
			<div class="w3-row">	
				<div class="w3-col s5">Email</div>
				<div class="w3-col s7"><?PHP echo $data["email"] ;?></div>
			</div>
			
			<div class="w3-padding"></div>
			<hr style="margin: 0px 0 0px 0;">
			<div class="w3-right">			
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class="w3-text-indigo"><i class="fa fa-fw fa-edit fa-lg"></i></a>			
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash-alt"></i></a>
			</div>
    </div>
</div>
<div class="w3-padding"></div>


<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:800px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update User</b>
			<hr>

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
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_user" value="<?PHP echo $data["id_user"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>SAVE CHANGES</b></button>
		</form>
		</div>
	</div>
<div class="w3-padding-24"></div>
</div>


<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Confirmation</b>
			  
			<hr class="w3-clear">			
			Are you sure to delete this record ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_user" value="<?PHP echo $data["id_user"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
			
			<button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
		</form>
		</div>
	</div>
</div>
<?PHP } ?>

<div class="w3-padding-64"></div>

</div>
	
<!-- Menu Footer -->
<div class="w3-containerx w3-bottom" id="contact">
    <div class="w3-content w3-containerx w3-padding-small w3-teal w3-center" style="max-width:600px">

	<div class="w3-row w3-small">
		<div class="w3-col s3">
			<a href="a-main.php" class="w3-button w3-hover-green w3-padding-small">
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
<!-- Menu Footer End -->

</body>
</html>
