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
$id_property= (isset($_REQUEST['id_property'])) ? trim($_REQUEST['id_property']) : '';
$act		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';

$error = "";
$success = false;

if($act == "Approved")
{
	$SQL_update = " UPDATE `property` SET `status` = 'Approved' WHERE `id_property` =  '$id_property' ";
	$result = mysqli_query($con, $SQL_update);
	
	print "<script>self.location='a-pending.php';</script>";
}

if($act == "Reject")
{
	$SQL_update = " UPDATE `property` SET `status` = 'Reject' WHERE `id_property` =  '$id_property' ";
	$result = mysqli_query($con, $SQL_update);
	
	print "<script>self.location='a-pending.php';</script>";
}

$SQL_list 	= "SELECT * FROM `property` WHERE `id_property` = '$id_property'  ";
$result 	= mysqli_query($con, $SQL_list) ;
$data		= mysqli_fetch_array($result);
$photo1		= $data["photo1"];
$photo2		= $data["photo2"];
$photo3		= $data["photo3"];
$photo4		= $data["photo4"];
$photo5		= $data["photo5"];
$photo6		= $data["photo6"];
$video		= $data["video"];
if(!$photo1) $photo1 = "noslide.png";
if(!$photo2) $photo2 = "noslide.png";
if(!$photo3) $photo3 = "noslide.png";
if(!$photo4) $photo4 = "noslide.png";
if(!$photo5) $photo5 = "noslide.png";
if(!$photo6) $photo6 = "noslide.png";
?>
<!DOCTYPE html>
<html>
<title>Housegoda</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
a:link {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Readex Pro", sans-serif}

body, html {
  height: 100%;
  line-height: 1.3;
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

	
<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-teal w3-center" style="max-width:600px">
		<a href="a-main.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
	</div>
</div>

<div class="w3-padding-16"></div>

<!-- Content -->

<!-- slide -->
<style>
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>

<div class="w3-content w3-display-container" style="max-width:600px">
  <img class="mySlides" src="upload/<?PHP echo $photo1; ?>" style="width:100%">
  <img class="mySlides" src="upload/<?PHP echo $photo2; ?>" style="width:100%">
  <img class="mySlides" src="upload/<?PHP echo $photo3; ?>" style="width:100%">
  <img class="mySlides" src="upload/<?PHP echo $photo4; ?>" style="width:100%">
  <?PHP if(!$photo5) { ?><img class="mySlides" src="upload/<?PHP echo $photo5; ?>" style="width:100%"><?PHP } ?>
  <?PHP if(!$photo6) { ?><img class="mySlides" src="upload/<?PHP echo $photo6; ?>" style="width:100%"><?PHP } ?>
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
    <?PHP if(!$photo5) { ?><span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(5)"></span><?PHP } ?>
    <?PHP if(!$photo6) { ?><span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(6)"></span><?PHP } ?>
  </div>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>
<script>
var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block"; 
  setTimeout(carousel, 2000); 
}
</script>
<!-- slide -->


<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:600px">
		<a href="a-photoslide.php?id_property=<?PHP echo $id_property;?>" class="w3-button w3-border w3-border-blue w3-text-blue w3-round"><i class="fas fa-images"></i> Photo</a>
		<?PHP if($video) { ?>
		<a href="<?PHP echo $video;?>" target="_blank" class="w3-button w3-border w3-border-blue w3-text-blue w3-round"><i class="fas fa-video"></i> Video</a>
		<?PHP } else { ?>
		<a class="w3-disabled w3-button w3-border w3-border-blue w3-text-blue w3-round"><i class="fas fa-video"></i> Video</a>
		<?PHP } ?>
		<a href="#map" class="w3-button w3-border w3-border-blue w3-text-blue w3-round"><i class="fas fa-map"></i> Map</a>
	</div>
</div>

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container " style="max-width:600px">
		<a href="a-review.php?id_property=<?PHP echo $id_property;?>" class="w3-right w3-tag w3-small w3-round">All Reviews</a>
		<div class="w3-xlarge"><b><?PHP echo $data["price"]; ?></b></div>
		<div class="w3-large"><b><?PHP echo $data["prop_name"]; ?></b></div>
		<span class="w3-text-indigo"><?PHP echo $data["address"]; ?></span>
		
		<div class="w3-padding"></div>
		
		<div class="w3-border w3-border-black w3-round-large">
			<div class="w3-row w3-tiny w3-center">
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-building fa-4x"></i><br>
					<?PHP echo $data["prop_type"]; ?>
				</div>
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-ruler-horizontal fa-4x"></i><br>
					<?PHP echo $data["buildup"]; ?> sqft
				</div>
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-bed fa-4x"></i><br>
					<?PHP echo $data["bedroom"]; ?> Bedroom
				</div>
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-couch fa-4x"></i><br>
					<?PHP echo $data["furnishing"]; ?>
				</div>
			</div>
			<div class="w3-row w3-tiny w3-center">
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-bath fa-4x"></i><br>
					<?PHP echo $data["bathroom"]; ?> Bathroom
				</div>
				<div class="w3-col s3 w3-padding">
					<i class="fas fa-car fa-4x"></i><br>
					<?PHP echo $data["parking"]; ?> Carpark
				</div>
			</div>
		</div>
		
		<div class="w3-padding"></div>
		
		<div class="w3-large">Description:</div>
		
		<?PHP echo $data["description"]; ?>
		
		<hr>
		
		<div id = "map"> </div>
		<div class="w3-large">Map:</div>
		
		<iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo $data["location"]; ?>&output=embed" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

		<hr>
	
	<div class="w3-padding-64"></div>
	
	</div>
</div>
<!-- Content End -->

<div class="w3-bottom" >
	<div class="w3-content w3-center w3-padding w3-padding-16 w3-white" style="max-width:600px">
	<?PHP if($data["status"] <> "Approved") { ?>
	<a href="?act=Approved&id_property=<?PHP echo $id_property;?>" class="w3-button w3-green w3-padding w3-padding-16 w3-round-xlarge"><i class="fa fa-fw fa-check fa-lg"></i> Approve</a>
	<?PHP } else { ?>
	<a href="#" class="w3-disabled w3-button w3-green w3-padding w3-padding-16 w3-round-xlarge"><i class="fa fa-fw fa-check fa-lg"></i> Approve</a>
	<?PHP } ?>
	<?PHP if($data["status"] <> "Reject") {?>
	<a href="?act=Reject&id_property=<?PHP echo $id_property;?>" class="w3-button w3-red w3-padding w3-padding-16 w3-round-xlarge"><i class="fa fa-fw fa-times fa-lg"></i> Reject</a>
	<?PHP } else { ?>
	<a href="#" class="w3-disabled w3-button w3-red w3-padding w3-padding-16 w3-round-xlarge"><i class="fa fa-fw fa-times fa-lg"></i> Reject</a>
	<?PHP } ?>
	</div>
</div>

</body>
</html>
