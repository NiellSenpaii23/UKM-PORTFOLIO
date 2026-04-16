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
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';

$is_owner	= (isset($_POST['is_owner'])) ? trim($_POST['is_owner']) : '0';
$prop_type	= (isset($_POST['prop_type'])) ? trim($_POST['prop_type']) : '';
$prop_name	= (isset($_POST['prop_name'])) ? trim($_POST['prop_name']) : '';
$address	= (isset($_POST['address'])) ? trim($_POST['address']) : '';
$postcode	= (isset($_POST['postcode'])) ? trim($_POST['postcode']) : '';
$location	= (isset($_POST['location'])) ? trim($_POST['location']) : '';
$pax		= (isset($_POST['pax'])) ? trim($_POST['pax']) : '0';
$room_type	= (isset($_POST['room_type'])) ? trim($_POST['room_type']) : '';
$bedroom	= (isset($_POST['bedroom'])) ? trim($_POST['bedroom']) : '';
$bathroom	= (isset($_POST['bathroom'])) ? trim($_POST['bathroom']) : '';
$buildup	= (isset($_POST['buildup'])) ? trim($_POST['buildup']) : '';
$parking	= (isset($_POST['parking'])) ? trim($_POST['parking']) : '';
$floor		= (isset($_POST['floor'])) ? trim($_POST['floor']) : '';
$furnishing	= (isset($_POST['furnishing'])) ? trim($_POST['furnishing']) : '';
$description= (isset($_POST['description'])) ? trim($_POST['description']) : '';
$price		= (isset($_POST['price'])) ? trim($_POST['price']) : '';
$video		= (isset($_POST['video'])) ? trim($_POST['video']) : '';

$prop_name	=	mysqli_real_escape_string($con, $prop_name);
$address	=	mysqli_real_escape_string($con, $address);
$description=	mysqli_real_escape_string($con, $description);

$id_user	= $_SESSION["id_user"];

$error = "";
$success = false;

if($act == "add")
{	
	$SQL_insert = " 	
		INSERT INTO `property`(`id_property`, `id_user`, `is_owner`, `prop_type`, `prop_name`, `address`, `postcode`, 
					`location`, `pax`, `room_type`, `bedroom`, `bathroom`, `buildup`, `parking`, `floor`, `furnishing`, 
					`description`, `price`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`, `photo6`, `video`, `status`, `created_date`) 
			VALUES (NULL, '$id_user', '$is_owner', '$prop_type', '$prop_name', '$address', '$postcode', 
					'$location', '$pax', '$room_type', '$bedroom', '$bathroom', '$buildup', '$parking', '$floor', '$furnishing', 
					'$description', '$price', '', '', '', '', '', '', '$video', 'Pending', NOW() ) ";

	$result = mysqli_query($con, $SQL_insert);
	
	$id_property = mysqli_insert_id($con);
	
	// -------- Photo -----------------
	if(($_FILES["photo1"]["error"] == 0) && (isset($_FILES['photo1']))) 
	{
		$file_name = $_FILES['photo1']['name'];
		$file_size = $_FILES['photo1']['size'];
		$file_tmp  = $_FILES['photo1']['tmp_name'];
		$file_type = $_FILES['photo1']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo1`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	// -------- Photo -----------------
	if(($_FILES["photo2"]["error"] == 0) && (isset($_FILES['photo2']))) 
	{
		$file_name = $_FILES['photo2']['name'];
		$file_size = $_FILES['photo2']['size'];
		$file_tmp  = $_FILES['photo2']['tmp_name'];
		$file_type = $_FILES['photo2']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo2`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	// -------- Photo -----------------
	if(($_FILES["photo3"]["error"] == 0) && (isset($_FILES['photo3']))) 
	{
		$file_name = $_FILES['photo3']['name'];
		$file_size = $_FILES['photo3']['size'];
		$file_tmp  = $_FILES['photo3']['tmp_name'];
		$file_type = $_FILES['photo3']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo3`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	// -------- Photo -----------------
	if(($_FILES["photo4"]["error"] == 0) && (isset($_FILES['photo4']))) 
	{
		$file_name = $_FILES['photo4']['name'];
		$file_size = $_FILES['photo4']['size'];
		$file_tmp  = $_FILES['photo4']['tmp_name'];
		$file_type = $_FILES['photo4']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo4`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	// -------- Photo -----------------
	if(($_FILES["photo5"]["error"] == 0) && (isset($_FILES['photo5']))) 
	{
		$file_name = $_FILES['photo5']['name'];
		$file_size = $_FILES['photo5']['size'];
		$file_tmp  = $_FILES['photo5']['tmp_name'];
		$file_type = $_FILES['photo5']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo5`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	// -------- Photo -----------------
	if(($_FILES["photo6"]["error"] == 0) && (isset($_FILES['photo6']))) 
	{
		$file_name = $_FILES['photo6']['name'];
		$file_size = $_FILES['photo6']['size'];
		$file_tmp  = $_FILES['photo6']['tmp_name'];
		$file_type = $_FILES['photo6']['type'];

		$fileNameCmps = explode(".", $file_name);
		$file_ext = strtolower(end($fileNameCmps));
		$new_file = rand() . "." . $file_ext;

		move_uploaded_file($file_tmp,"upload/".$new_file);

		$query = "UPDATE `property` SET `photo6`='$new_file' WHERE `id_property` = '$id_property'";			
		$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
	}
	// -------- End Photo -----------------
	
	
	$success = "Successfully Submitted";
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

<!-- include summernote css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- include summernote js-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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
		<b>New Rent</b>
		</span>
	</div>
</div>

<div class="w3-padding-32"></div>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "main.php"); }
?>	
<!-- Content -->

<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-large "><b>Property Type</b></div>
			<span class="w3-padding w3-border w3-round-large"><input class="w3-radio" type="radio" name="prop_type" value="Landed" ><label> Landed</label></span>&nbsp;
			<span class="w3-padding w3-border w3-round-large"><input class="w3-radio" type="radio" name="prop_type" value="Room" checked><label> Room</label></span>
			<hr>
			
			<div class="w3-large "><b>Where is your property located?</b></div>
			
			<input class="w3-check" type="checkbox" name="is_owner" value="1">&nbsp;
			<label>I'm owner of this unit</label>
			
			<div class="w3-section" >
				Property Name *
				<input class="w3-input w3-border w3-round-large" type="text" name="prop_name" placeholder="eg: Shah Alam" required>
			</div>
			
			<div class="w3-section" >
				Address *
				<input class="w3-input w3-border w3-round-large" type="text" name="address" placeholder="eg: Jalan Bayu 3/9" required>
			</div>

			<div class="w3-section" >
				Postcode *
				<input class="w3-input w3-border w3-round-large" type="text" name="postcode" placeholder="eg: 45000" required>
			</div>
			
			<div class="w3-section" >
				Location Map *
				<textarea class="w3-input w3-border w3-round-large" rows="3" name="location" placeholder="Add address located in google map" required></textarea>
			</div>
			
			<hr>
			
			<div class="w3-large "><b>Share some details about your property</b></div>
			
			<div class="w3-section" >
				Bedroom *
				<select class="w3-input w3-border w3-round-large hue-blue w3-padding" style="height:45px" name="bedroom" required>
					<option value="1" >1</option>
					<option value="2" >2</option>
					<option value="3" >3</option>
					<option value="4" >4</option>
					<option value="5" >5</option>
					<option value="6" >6</option>
					<option value="7" >7</option>
					<option value="8" >8</option>
					<option value="9" >9</option>
					<option value="10" >10</option>
				</select>
			</div>
			
			<div class="w3-section" >
				Bathroom *
				<select class="w3-input w3-border w3-round-large hue-blue w3-padding" style="height:45px" name="bathroom" required>
					<option value="1" >1</option>
					<option value="2" >2</option>
					<option value="3" >3</option>
					<option value="4" >4</option>
					<option value="5" >5</option>
					<option value="6" >6</option>
					<option value="7" >7</option>
					<option value="8" >8</option>
					<option value="9" >9</option>
					<option value="10" >10</option>
				</select>
			</div>
			
			<div class="w3-section" >
				Parking *
				<select class="w3-input w3-border w3-round-large hue-blue w3-padding" style="height:45px" name="parking" required>
					<option value="1" >1</option>
					<option value="2" >2</option>
					<option value="3" >3</option>
					<option value="4" >4</option>
				</select>
			</div>
			
			<div class="w3-section" >
				Build up size (sqft) *
				<input class="w3-input w3-border w3-round-large" type="number" name="buildup" placeholder="" required>
			</div>
			
			<div class="w3-section" >
				Floor Level *
				<select class="w3-input w3-border w3-round-large hue-blue w3-padding" style="height:45px" name="floor" required>
					<option value="Single" >Single</option>
					<option value="Double" >Double</option>
					<option value="More than 2 Storeys" >More than 2 Storeys</option>
				</select>
			</div>
			
			<div class="w3-section" >
				Furnishing *
				<select class="w3-input w3-border w3-round-large hue-blue w3-padding" style="height:45px" name="furnishing" required>
					<option value="Unfurnised" >Unfurnised</option>
					<option value="Partially Furnished" >Partially Furnished</option>
					<option value="Fully Furnished" >Fully Furnished</option>
				</select>
			</div>
			
			<div class="w3-section" >
				Description *
				<textarea class="w3-input w3-border w3-round-large" rows="4" name="description" id="makeMeSummernote2" placeholder="Add description here" required></textarea>
			</div>
			
			<hr>
			
			<div class="w3-large "><b>How much is your rental price?</b></div>
			<div class="w3-section" >
				Price
				<input class="w3-input w3-border w3-round-large" type="text" name="price" value="" placeholder="RM 1,500/month" required>
			</div>
			
			<hr>
			
			<div class="w3-large "><b>Photo & Video Link</b></div>
			
			<div class="w3-section" >
				<label>Photo (1) *</label>
				<input class="w3-input w3-border w3-round" type="file" name="photo1" required >
				<small>  only JPEG, JPG, PNG or GIF allowed </small>
			</div>
			
			<div class="w3-section" >
				<label>Photo (2) *</label>
				<input class="w3-input w3-border w3-round" type="file" name="photo2" required >
			</div>
			
			<div class="w3-section" >
				<label>Photo (3) *</label>
				<input class="w3-input w3-border w3-round" type="file" name="photo3" required >
			</div>
			
			<div class="w3-section" >
				<label>Photo (4) *</label>
				<input class="w3-input w3-border w3-round" type="file" name="photo4" required >
			</div>
			
			<div class="w3-section" >
				<label class="w3-text-gray">Photo (5) </label>
				<input class="w3-input w3-border w3-round" type="file" name="photo5"  >
			</div>
			
			<div class="w3-section" >
				<label class="w3-text-gray">Photo (6) </label>
				<input class="w3-input w3-border w3-round" type="file" name="photo6"  >
			</div>
				
			<div class="w3-section" >
				360 Video URL
				<input class="w3-input w3-border w3-round-large" type="text" name="video" placeholder="Enter Youtube URL only">
			</div>

			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="act" type="hidden" value="add">
				<button type="submit" class="w3-padding-large w3-block w3-button  w3-margin-bottom w3-round-xxlarge w3-green"><b>SUBMIT</b></button>
			</div>
		</form>
		
	</div>
</div>
<!-- Content End -->



</body>
</html>

<!-- Script -->
<script type="text/javascript">
	$('#makeMeSummernote,#makeMeSummernote2').summernote({
		height:200,
		toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		]
	});
</script>
