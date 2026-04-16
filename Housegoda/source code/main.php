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
$search		= (isset($_POST['search'])) ? trim($_POST['search']) : '';

$new_booking= numRows($con, "SELECT * FROM `booking` WHERE `id_owner` = $id_user AND `status` = 'Pending' ");
$new_accept	= numRows($con, "SELECT * FROM `booking` WHERE `id_user` = $id_user AND `status` = 'Accept' AND `is_viewed` = 0");
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

<body class="" >

<!-- menu top -->
<div class="w3-top " id="contact">
	
	<div class="w3-content w3-containerx w3-white" style="max-width:600px">
	<div class="w3-marginx w3-padding w3-center" >
		<a href="main.php"><img src="images/logo-small.jpg" class="w3-image"></a>
    </div>
	
	<div class="w3-marginx w3-padding-small " >
	<form action="" method="post" class="">
		<div class="w3-center">
			<input class="w3-padding w3-border w3-border-indigo w3-round-xlarge" type="text" name="search" value="<?PHP echo $search;?>" placeholder="Find your sweet home.." >
			<button type="submit" class="w3-button w3-circle"><i class="fa fa-search fa-lg w3-text-indigo"></i></button>
		</div>
	</form> 
	</div>
	</div>
</div>





<div class="w3-padding-64"></div>

<!-- content -->	
<div class="w3-containerx " id="contact">
    <div class="w3-content w3-containerx " style="max-width:600px">	
	
		<?PHP
		$SQL_search = "";
		if($search) $SQL_search = "AND `prop_name` LIKE '%$search%' ";
		$bil = 0;
		$SQL_list = "SELECT * FROM `property` WHERE `status` = 'Approved' $SQL_search";
		$result = mysqli_query($con, $SQL_list) ;
		while ( $data	= mysqli_fetch_array($result) )
		{
			$bil++;
			$id_property= $data["id_property"];
			$photo1		= $data["photo1"];
			
			$displayLike = "fa fa-heart-o";
			$liked 	= numRows($con, "SELECT * FROM `favourite` WHERE `id_property` = '$id_property' AND `id_user` = $id_user");
			if($liked > 0) $displayLike = "fa fa-heart w3-text-red";
			
			$tot_photo = 1;
			if($data["photo2"]) $tot_photo = 2;
			if($data["photo3"]) $tot_photo = 3;
			if($data["photo4"]) $tot_photo = 4;
			if($data["photo5"]) $tot_photo = 5;
			if($data["photo6"]) $tot_photo = 6;
			
			$reviewed 	= numRows($con, "SELECT * FROM `review` WHERE `id_property` = '$id_property'");
			
			$rst_rate 	= mysqli_query($con, "SELECT SUM(rating) as tot_rating FROM `review` WHERE `id_property` = '$id_property'") ;
			$dat_rate	= mysqli_fetch_array($rst_rate);
			$tot_rating	= $dat_rate["tot_rating"];
			
			if($reviewed > 0) 	
				$rate_avg	= $tot_rating / $reviewed;
			else 
				$rate_avg = 0;
		?>	
		<div class="w3-margin w3-padding " >
			<a href="property.php?id_property=<?PHP echo $id_property;?>">
			<div class="w3-border w3-card w3-sand w3-round-xlarge">
				<div class="w3-display-container">
				<img src="upload/<?PHP echo $photo1;?>" class="w3-image w3-round-xlarge">
				<span class="w3-display-bottomleft w3-text-white w3-margin w3-tag w3-small"><i class="fa fa-fw fa-image"></i> <?PHP echo $tot_photo;?> </span>
				</div>
				<div class="w3-padding">
				<a href="favourite.php?act=add&id_property=<?PHP echo $id_property;?>" class="w3-right"><i class="<?PHP echo $displayLike; ?>"></i></a>
				<b class="w3-large"><?PHP echo $data["price"]; ?></b><br>
				
				<b><?PHP echo $data["prop_name"]; ?></b><br>
				<?PHP 
				for($star = 1; $star < 6; $star++)
				{
					if($star <= $rate_avg) echo '<i class="fa fa-star w3-text-amber"></i>';
				}
				?>
				<?PHP echo $reviewed;?> Reviews<br>
				<span class="w3-text-grey"><?PHP echo $data["furnishing"]; ?> | <?PHP echo $data["buildup"]; ?> sqft</span>
				</div>
			</div>
			</a>
		</div>
		
		<?PHP } ?>	
	
	</div>
</div>

<div class="w3-padding-64"></div>



<!-- content end -->

<!-- Menu Footer -->
<div class="w3-containerx w3-bottom" id="contact">
    <div class="w3-content w3-containerx w3-padding-small w3-teal w3-center" style="max-width:600px">

	<div class="w3-row w3-small">
		<div class="w3-col s3">
			<a href="main.php" class="w3-button w3-hover-green w3-padding-small w3-text-lime">
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
			<a href="favourite.php" class="w3-button w3-hover-green w3-padding-small">
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


<div id="idPending" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idPending').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Notification</b>
			  
			<hr class="w3-clear">
			
			You have New Booking request
			
			<div class="w3-padding-16"></div>
			

			<button type="button" onclick="document.getElementById('idPending').style.display='none'"  class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">CLOSE</button>
			
			<a href="listing-booking.php" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">VIEW LIST</a>

		</form>
		</div>
	</div>
</div>

<div id="idAccept" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idAccept').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
			<div class="w3-padding"></div>
			<b class="w3-large">Update Notification</b>
			 
			<?PHP 			
			$SQL_list 	= "SELECT * FROM `booking` WHERE `id_user` = $id_user AND `status` = 'Accept' ";
			$result 	= mysqli_query($con, $SQL_list) ;
			$data		= mysqli_fetch_array($result);				
			?>
			
			<hr class="w3-clear">
			
			Congratulation. Your booking is accepted! Please contact owner.
			
			<div class="w3-padding-16"></div>
			

			<button type="button" onclick="document.getElementById('idAccept').style.display='none'"  class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round">CLOSE</button>
			
			<a href="is_viewed.php?id_booking=<?PHP echo $data["id_booking"]; ?>&id_property=<?PHP echo $data["id_property"]; ?>" class="w3-right w3-button w3-green w3-text-white w3-margin-bottom w3-round">SEE PROPERTY</a>
		</div>
	</div>
</div>

<script>
function PopupPending(){
	document.getElementById('idPending').style.display='block';
}

function PopupAccept(){
	document.getElementById('idAccept').style.display='block';
}
</script>


<?PHP 
if($new_booking > 0) {
	print "<script>PopupPending();</script>";
};


if($new_accept > 0) {
	print "<script>PopupAccept();</script>";
}
?>

</body>
</html>
