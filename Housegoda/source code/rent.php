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
		<b>Rent</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		<div class="w3-xlarge"><b>Currently renting...</b></div>
		- Nota# Page ini perlu dibuang -
		<div class="w3-padding-16"></div>
		
		<div class="w3-margin w3-padding " >
			<div class="w3-border w3-border-indigo w3-sand w3-round-xlarge">
				<img src="upload/house.png" class="w3-image w3-round-xlarge">
				<div class="w3-padding">
				<a href="favourite.php" class="w3-right"><i class="fa fa-heart w3-text-indigo"></i></a>
				<b>RM 1,300</b><br>
				
				Home D'saru<br>
				<i class="fa fa-star w3-text-amber"></i>
				<i class="fa fa-star w3-text-amber"></i>
				<i class="fa fa-star w3-text-amber"></i>
				<i class="fa fa-star w3-text-amber"></i>
				<i class="fa fa-star w3-text-amber"></i>
				7.3 Reviews<br>
				Fully Furnished | 743 sqft
				</div>
			</div>
		</div>
				
	</div>
</div>
<!-- Content End -->



</body>
</html>
