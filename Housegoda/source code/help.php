<?PHP
session_start();

include("database.php");
if( !verifyUser($con) ) 
{
	header( "Location: index.php" );
	return false;
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

	
<div class="w3-padding"></div>

<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-teal w3-center" style="max-width:450px">
		<a href="account.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>Help</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		<div class="w3-xlarge"><b>Support</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding">
			<a href="tel:+60176646241">
			<div class="w3-teal w3-hover-green w3-padding w3-padding-16 w3-round-xlarge">		
				<div class="w3-row">
					<div class="w3-col s9">
						<div class="w3-large"><b>Contact</b></div>			
						24 Hours
					</div>
					<div class="w3-col s3">
						<i class="fa fa-phone fa-4x"></i>
					</div>
				</div>			
			</div>
			</a>
		</div>
		
		<div class="w3-padding">
			<a href="https://wa.me/60176646241">
			<div class="w3-teal w3-hover-green w3-padding w3-padding-16 w3-round-xlarge">		
				<div class="w3-row">
					<div class="w3-col s9">
						<div class="w3-large"><b>Message</b></div>			
						Whatsapp
					</div>
					<div class="w3-col s3">
						<i class="fa fa-whatsapp fa-4x"></i>
					</div>
				</div>			
			</div>
			</a>
		</div>
		
		<div class="w3-padding">
			<a href="mailto:email@gmail.com">
			<div class="w3-teal w3-hover-green w3-padding w3-padding-16 w3-round-xlarge">		
				<div class="w3-row">
					<div class="w3-col s9">
						<div class="w3-large"><b>Email Us</b></div>			
						24 Hours
					</div>
					<div class="w3-col s3">
						<i class="fa fa-envelope fa-4x"></i>
					</div>
				</div>			
			</div>
			</a>
		</div>
				
	</div>
</div>
<!-- Content End -->



</body>
</html>
