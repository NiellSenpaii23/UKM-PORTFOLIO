<?PHP
	/*	-----------------------------
		Developed by : BelajarPHP.com
		Date : 22 Oct 2023
		-----------------------------	*/
		

	//http://housegoda.000.pe/index_app.php
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	if($_SERVER['HTTP_HOST']=="localhost")
	{	
		//localhost
		$dbHost = "localhost";	// Database host
		$dbName = "housegoda";		// Database name
		$dbUser = "root";		// Database user
		$dbPass = "";			// Database password
	}
	else
	{
		//local live @ hosting
		$dbHost = "sql208.infinityfree.com";	// Database host
		$dbName = "if0_35466005_housegoda";		// Database name
		$dbUser = "if0_35466005";	// Database user
		$dbPass = "mw9ZBSbZVD";		// Database password

	}
	
	$con = mysqli_connect($dbHost,$dbUser ,$dbPass,$dbName);
	
	
	function verifyAdmin($con)
	{
		if ($_SESSION['username'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `admin` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}
	
	function verifyUser($con)
	{
		if ($_SESSION['email'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `email`, `password` FROM `user` WHERE `email`='$_SESSION[email]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}

	function numRows($con, $query) {
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
	
	function Notify($status, $alert, $redirect)
	{
		$color = ($status == "success") ? "w3-text-yellow" : "w3-text-red";


		
		echo '<div class="'.$color.' w3-black w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';
			
		//localhost
		if($_SERVER['HTTP_HOST']=="localhost" )
			header( "refresh:1;url=$redirect" );
		else
			print "<script>self.location='$redirect';</script>";
	}
	
	
	function substrwords($text, $maxchar, $end='...') {
		if (strlen($text) > $maxchar || $text == '') {
			$words = preg_split('/\s/', $text);      
			$output = '';
			$i      = 0;
			while (1) {
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				} 
				else {
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		} 
		else {
			$output = $text;
		}
		return $output;
	}
	
	function resizeImage($resourceType,$image_width,$image_height) {
		$resizeWidth 	= 300;
		$resizeHeight 	= 300;
		$imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
		imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
		return $imageLayer;
	}
	
?>