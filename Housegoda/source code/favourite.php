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
$act 		= (isset($_GET['act'])) ? trim($_GET['act']) : '';	

$id_favourite= (isset($_GET['id_favourite'])) ? trim($_GET['id_favourite']) : '';
$id_property= (isset($_GET['id_property'])) ? trim($_GET['id_property']) : '';
$id_user	= $_SESSION["id_user"];

$error = "";
$success = false;

if($act == "add")
{	
	$found 	= numRows($con, "SELECT * FROM `favourite` WHERE `id_property` = '$id_property' AND `id_user` = $id_user");
	if($found) $error ="Email already registered";
}

if(($act == "add") && (!$error))
{	
	$SQL_insert = " 
	INSERT INTO `favourite`(`id_favourite`, `id_property`, `id_user`) VALUES (NULL, '$id_property', '$id_user') ";
										
	$result = mysqli_query($con, $SQL_insert);
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `favourite` WHERE `id_favourite` =  '$id_favourite' ";
	$result = mysqli_query($con, $SQL_delete);
	
	print "<script>self.location='favourite.php';</script>";
}

$count = numRows($con, "SELECT * FROM `favourite` WHERE `id_user` = $id_user");
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
		<a href="main.php" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>My Favourite</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		<div class="w3-xlarge"><b>Favourite</b></div>
		You have favourited <?PHP echo $count;?> houses
		<div class="w3-padding"></div>
		
		<?PHP
		$SQL_list = "SELECT * FROM `favourite`,`property` 
			WHERE favourite.id_property = property.id_property AND favourite.id_user = $id_user";
		$result = mysqli_query($con, $SQL_list) ;
		while ( $data	= mysqli_fetch_array($result) )
		{
			$id_favourite= $data["id_favourite"];
			$id_property= $data["id_property"];
			$photo1		= $data["photo1"];
		?>
		<div class="w3-col s6 w3-padding">
			<div class="w3-display-container">
			<img src="upload/<?PHP echo $photo1;?>" class="w3-image w3-round-large">
			<a href="?act=del&id_favourite=<?PHP echo $id_favourite; ?>" class="w3-display-topleft w3-padding-small w3-text-red"><i class="fa fa-trash"></i></a>
			</div>
			<a href="property.php?id_property=<?PHP echo $id_property;?>" class="w3-text-indigo"><?PHP echo $data["prop_name"]; ?></a><br>
			<b><?PHP echo $data["price"]; ?></b>
		</div>
		<?PHP } ?>


	</div>
</div>
<!-- Content End -->

<!-- Menu Footer -->
<div class="w3-containerx w3-bottom" id="contact">
    <div class="w3-content w3-containerx w3-padding-small w3-teal w3-center" style="max-width:450px">

	<div class="w3-row w3-small">
		<div class="w3-col s3">
			<a href="main.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-home.jpg" class="w3-circle"><br>
				HOME
			</a>
		</div>
		<div class="w3-col s3">
			<a href="new-rent.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-rent.jpg" class="w3-circle"><br>
				NEW RENT
			</a>
		</div>
		<div class="w3-col s3">
			<a href="favourite.php" class="w3-button w3-hover-green w3-padding-small w3-text-lime">
				<img src="images/ico-fav.jpg" class="w3-circle"><br>
				FAV
			</a>
		</div>
		<div class="w3-col s3">
			<a href="account.php" class="w3-button w3-hover-green w3-padding-small">
				<img src="images/ico-acc.jpg" class="w3-circle"><br>
				ACCOUNT
			</a>
		</div>
	</div>
	
	</div>
</div>

</body>
</html>
