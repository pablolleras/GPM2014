<?php
	session_start();
	$mysql_host = "mysql1.000webhost.com";
	$mysql_database = "a3120811_gpm";
	$mysql_user = "a3120811_plleras";
	$mysql_password = "Canada2654";
	$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
	$uid = $_SESSION['UserId'];
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// escape variables for security

	// $email = mysqli_real_escape_string($con, $_POST['email']);
	// $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	// $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	// $pass = mysqli_real_escape_string($con, $_POST['pass']);

	// $password = md5($pass);
	//$rounds = array("R1F1","R1F2","R1F3","R2F1","R2F2","QRTS","SEMI","FINAL");
	$matchnum = 0;
	$incflag = -1;
	$oldscore = 0;
	foreach($_POST['score'][$uid] as $rnd => $val) {
		foreach($val as $sub => $value) {
         	//$data = array($sub => $value);

         	if($incflag % 2 === 0){
         		$matchnum++;         		
    			//echo "<br>Round: ",$rnd," Match: ",$matchnum," Team:",($sub%2)+1," Score:",$oldscore,"-",$value;

    			$result = mysqli_query($con,"SELECT * FROM `Scores` WHERE UserId = '".$uid."' AND RoundNum = '".$rnd."' And GameNum = '".$matchnum."'");
    			
    			if (!$result || mysqli_num_rows($result) === 0) {
				    $sql="INSERT INTO `Scores` (UserId, RoundNum, GameNum, Team1, Team2)
						VALUES ('$uid', '$rnd', '$matchnum', '$oldscore', '$value')";				    
				} else {
					$sql= "UPDATE `Scores` SET Team1 = '".$oldscore."', Team2 = '".$value."' WHERE UserId = '".$uid."' AND RoundNum = '".$rnd."' And GameNum = '".$matchnum."'";				
				}

				if (!mysqli_query($con,$sql)) {
				  die('Error: ' . mysqli_error($con));
				}

				$key1 = $rnd."M".$matchnum."A";
                $val1 = $oldscore;
                $key2 = $rnd."M".$matchnum."B";
                $val2 = $value;

                $_SESSION[$key1] = $val1;
                $_SESSION[$key2] = $val2;

         	} else {
         		$oldscore = $value;
         	}
         	$incflag++;
     	}    
     	$matchnum = 0;
	}	
	
	// echo "<script type='text/javascript'>alert('Marcadores guardados');
	// 			window.location='http://www.gpm2014.tk#download';
	// 		  </script>";
	header("Location: http://www.gpm2014.tk#download");
	mysqli_close($con);
?>