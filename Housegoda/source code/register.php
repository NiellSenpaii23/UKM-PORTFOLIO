<?PHP
include("database.php");

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';
$firstname	= (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
$secondname	= (isset($_POST['secondname'])) ? trim($_POST['secondname']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$firstname		=	mysqli_real_escape_string($con, $firstname);

$error = "";
$success = false;

if($act == "register")
{	
	$found 	= numRows($con, "SELECT * FROM `user` WHERE `email` = '$email' ");
	if($found) $error ="Email already registered";
}

if(($act == "register") && (!$error))
{	
	$SQL_insert = " 	
	INSERT INTO `user`(`id_user`, `firstname`, `secondname`, `phone`, `email`, `password`, `photo`) 
			VALUES (NULL,'$firstname','$secondname','$phone','$email','$password', '') ";
	
	$result = mysqli_query($con, $SQL_insert);
	$success = true;
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
  /*background-size: 100%;*/
  background-size: cover;
  background-image: url("images/back2.jpg");
  min-width: 100%;
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

<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-green w3-center" style="max-width:450px">
		<a href="index.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>Register</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>
	
<div class="w3-containerx" id="contact">
    <div class="w3-content w3-containerx " style="max-width:450px">
	<div class="w3-margin w3-padding " >	
		
		<div class="w3-xlarge">
		<b>Sign Up</b>
		</div>
	
<?PHP if($error) { ?>
<div class="w3-panel w3-center w3-pale-red w3-display-container w3-animate-zoom">
	<h3>Error!</h3>
	<?PHP echo $error;?>
</div>	
<?PHP } ?>
	

<?PHP if($success) { ?>
<div class="w3-panel w3-center w3-pale-green w3-display-container w3-animate-zoom">
  <h3>Congratulation!</h3>
  <p>Your registration has been successful!<br>You can now <a href="index.php"><b>Login</b>.</a> </p>
</div>
<?PHP  } else { ?>	
		<form action="" method="post" class="">
			
			<div class="w3-section" >
				<input class="w3-input w3-border w3-round-large" type="text" name="firstname" placeholder="First Name" required>
			</div>
			
			<div class="w3-section" >
				<input class="w3-input w3-border w3-round-large" type="text" name="secondname" placeholder="Second Name" required>
			</div>

			<div class="w3-section" >
				<input class="w3-input w3-border w3-round-large" type="email" name="email" placeholder="Email Address" required>
			</div>
			
			<div class="w3-section" >
				<input class="w3-input w3-border w3-round-large" type="number" name="phone" placeholder="Phone Number" required>
			</div>

			<div class="w3-section">
				<input class="w3-input w3-border w3-round-large cpwdx" type="password" name="password" id="password" placeholder="Password" required>

				<div class="w3-center w3-text-gray">Password must at least be 6 characters</div>
			</div>

			<div class="w3-section">
				<input class="w3-input w3-border w3-round-large cpwdx" type="password" name="repassword" id="repassword" placeholder="Confirm Password" required>
				<div class="w3-padding "><input type="checkbox" onclick="myFunction()"> Show Password</div>
			</div>

			<script>
			function myFunction() {
			  var x = document.getElementById("password");
			  var y = document.getElementById("repassword");
			  if (x.type === "password") {
				x.type = "text";
				y.type = "text";
			  } else {
				x.type = "password";
				y.type = "password";
			  }
			}
			</script>

			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="act" type="hidden" value="register">
				<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>REGISTER</b></button>
			</div>
		</form> 
		
		<div class="w3-center ">By signup you agree with our <a href="#" onclick="document.getElementById('idTerm').style.display='block'" class="w3-text-red">Terms and Conditions</a></div>
		
<?PHP  }  ?>	
		
		<hr style="margin: 5px 0 5px 0;">
		<div class="w3-center ">Already have an account? <a href="index.php" class="w3-text-green">Log In</a></div>
			
	</div>	
    </div>
</div>



<div class="w3-padding-16"></div>

<!--
<div class="w3-center w3-small w3-padding-24 w3-text-white">demo ver by BelajarPHP.com</div>
-->


</div>


<div id="idTerm" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idTerm').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
				
			<div class="w3-padding"></div>
			<b class="w3-large">Terms & Conditions</b>
			  
			<hr class="w3-clear">
			
			<p>Lorem ipsum dolor sit amet. Vel delectus explicabo qui voluptatum blanditiis aut beatae quia et ipsam enim rem explicabo placeat. Ad minus mollitia hic officia alias ex temporibus dolores et totam autem non dolorum quae est vitae ratione et alias beatae. Aut rerum assumenda aut esse illo ut necessitatibus doloribus est omnis quam. Sit ipsa quam sed Quis nihil quo debitis eaque ut iusto repellat et veritatis labore aut ullam repellendus et nulla repellat.</p>
			<p>Aut alias illo vel dolore error sed enim quia et vero veniam. Eos velit laborum id quia fuga ut dolor culpa vel error voluptatum ea illum velit aut voluptates sunt. Qui cupiditate doloribus hic tempore enim et expedita adipisci. Et recusandae modi in sunt soluta qui nisi voluptas ut Quis consectetur ut sint placeat.</p>
			
			<div class="w3-padding-16"></div>
			
			<button type="button" onclick="document.getElementById('idTerm').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CLOSE</button>		
		</div>
	</div>
</div>	


</body>
</html>