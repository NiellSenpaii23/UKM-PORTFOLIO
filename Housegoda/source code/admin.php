<?PHP
session_start();
?>
<?PHP
include("database.php");

$username 	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';

$error = "";

if($act == "login")
{	
	$SQL_login 	= " SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["username"] 	= $username;
		$_SESSION["password"] 	= $password;
		$_SESSION["id_admin"] 	= $data["id_admin"];
		header("Location:a-main.php");
	}else{
		$error = "Invalid";
		header("refresh:1;url=admin.php");
	}
}
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


<div class="" >

	
<div class="w3-padding"></div>


<div class="w3-containerx " id="contact">
    <div class="w3-content w3-containerx " style="max-width:600px">
	<div class="w3-margin w3-padding " >
		<div class="w3-center"><img src="images/logo.jpg" class="w3-image" width="200px"></div>

		<div class="w3-padding-16"></div>
	
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-xlarge">
		<b>Administrator</b>
		</div>

	
	<?PHP if($error) { ?>
		<div class="w3-container w3-center w3-text-red" id="contact">
				<div class="w3-large">Error! Invalid login</div>
				Please try again...
		</div>	
	<?PHP } ?>
	
		
		<form action="" method="post" class="">
			
			  <div class="w3-section" >
				<input class="w3-input w3-border w3-padding w3-round-large" type="username" name="username" placeholder="Username" required>
			  </div>
			  <div class="w3-section">
				<input class="w3-input w3-border w3-padding w3-round-large cpwdx" type="password" name="password" id="password" placeholder="Password" required>
				<div class="w3-padding "><input type="checkbox" onclick="myFunction()"> Show Password</div>
			  </div>
			  
				<script>
				function myFunction() {
				  var x = document.getElementById("password");
				  if (x.type === "password") {
					x.type = "text";
				  } else {
					x.type = "password";
				  }
				}
				</script>
				
			  <div class="w3-padding-16"></div>
			  
			  <div class="w3-center">
			  <input name="act" type="hidden" value="login">
			  <button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>SIGN IN</b></button>
			  </div>
		</form>
				
		
    </div>
	</div>
</div>

<div class="w3-padding-16"></div>
<div class="w3-center "><a href="index.php" class="w3-text-green">User</a></div>	

</div>
	


</body>
</html>