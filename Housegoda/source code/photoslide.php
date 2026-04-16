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
$id_property	= (isset($_REQUEST['id_property'])) ? trim($_REQUEST['id_property']) : '';

$SQL_list 	= "SELECT * FROM `property` WHERE `id_property` = '$id_property'  ";
$result 	= mysqli_query($con, $SQL_list) ;
$data		= mysqli_fetch_array($result);
$photo1		= $data["photo1"];
$photo2		= $data["photo2"];
$photo3		= $data["photo3"];
$photo4		= $data["photo4"];
$photo5		= $data["photo5"];
$photo6		= $data["photo6"];
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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css2?family=Readex+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
a:link {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Readex Pro", sans-serif}
</style>

<body class="w3-black">
<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 w3-center" style="max-width:450px">
		<a href="property.php?id_property=<?PHP echo $id_property;?>" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>Photo</b>
		</span>
	</div>
</div>

<div class="w3-padding-small"></div>
<div class="w3-padding-32"></div>


<div class="w3-content" style="max-width:600px">
  <img class="mySlides" src="upload/<?PHP echo $photo1; ?>" style="width:100%;">
  <img class="mySlides" src="upload/<?PHP echo $photo2; ?>" style="width:100%;display:none">
  <img class="mySlides" src="upload/<?PHP echo $photo3; ?>" style="width:100%;display:none">
  <img class="mySlides" src="upload/<?PHP echo $photo4; ?>" style="width:100%;display:none">
  <?PHP if(!$photo5) { ?><img class="mySlides" src="upload/<?PHP echo $photo5; ?>" style="width:100%;display:none"><?PHP } ?>
  <?PHP if(!$photo6) { ?><img class="mySlides" src="upload/<?PHP echo $photo6; ?>" style="width:100%;display:none"><?PHP } ?>

  <div class="w3-row-padding w3-section">
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo1; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(1)">
    </div>
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo2; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(2)">
    </div>
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo3; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(3)">
    </div>
	<div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo4; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(4)">
    </div>
	<?PHP if(!$photo5) { ?>
	<div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo5; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(5)">
    </div>
	<?PHP } ?>
	<?PHP if(!$photo6) { ?>
	<div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="upload/<?PHP echo $photo6; ?>" style="width:100%;height:100px;cursor:pointer" onclick="currentDiv(6)">
    </div>
	<?PHP } ?>
  </div>
</div>

</body>

<script>
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
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
</html>