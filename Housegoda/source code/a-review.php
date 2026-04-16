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
		<a href="a-property.php?id_property=<?PHP echo $id_property;?>" class="w3-left"><i class="fa fa-fw fa-chevron-left fa-lg"></i></a>   
		<span class="w3-xlarge w3-center">
		<b>All Review</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		<div class="w3-xlarge"><b>Reviews</b></div>
		
		<div class="w3-padding"></div>
		
		<?PHP
		$SQL_list = "SELECT * FROM `review`,`user` WHERE review.id_user = user.id_user AND review.id_property =  $id_property";
		$result = mysqli_query($con, $SQL_list) ;
		while ( $data	= mysqli_fetch_array($result) )
		{
			$id_review	= $data["id_review"];
			$id_property= $data["id_property"];
			$rating		= $data["rating"];
			$photo		= $data["photo"];
			if(!$photo) $photo = "noimage.png";
		?>
		<div class="w3-row w3-small">
			<div class="w3-col s2">
				<img src="upload/<?PHP echo $photo; ?>" class="w3-circle w3-border w3-image" alt="image" style="width:40px;">
			</div>
			<div class="w3-col s7">
				<?PHP echo $data["firstname"]; ?><br>
				<?PHP 
				for($i = 1; $i <=5; $i++) { 
					if($rating >= $i) echo '<i class="fa fa-star w3-text-amber"></i>';
				} ?>
			</div>
			<div class="w3-col s3">
			<?PHP echo $data["created_date"]; ?>
			</div>
		</div>
		
		<p>
		<?PHP echo $data["review"]; ?>
		</p>
		<hr class="w3-black">
		<?PHP } ?>

	</div>
</div>
<!-- Content End -->

<!-- Menu Footer -->
<div class="w3-containerx w3-bottom" id="contact">
    <div class="w3-content w3-containerx w3-padding-small w3-teal w3-center" style="max-width:450px">

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

</body>
</html>
