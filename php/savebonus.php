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

	$data = array('UserId' => $uid);
	foreach($_POST['bonus'][$uid] as $grp => $val) {
		foreach($val as $sub => $value) {
         	$key = $grp."".($sub+1);
         	$data[$key]=$value;
     	}    
	}	
	
	$result = mysqli_query($con,"SELECT * FROM `Bonus` WHERE UserId = '".$uid."'");
	$columns = implode(", ",array_keys($data));
	$values  = implode("', '", array_values($data));			

	echo $columns, "<br>", $values, "<br>";

	if (!$result || mysqli_num_rows($result) === 0) {
	    $sql = "INSERT INTO `Bonus` ($columns) VALUES ('$values')";				    
	} else {
	 	$sql= "UPDATE `Bonus` SET A1 = '".$data['A1']."', A2 ='".$data['A2']."', B1 ='".$data['B1']."', B2 ='".$data['B2']."', C1 ='".$data['C1']."', C2 ='".$data['C2']."', D1 ='".$data['D1']."', D2 ='".$data['D2']."', E1 ='".$data['E1']."', E2 ='".$data['E2']."', F1 ='".$data['F1']."', F2 ='".$data['F2']."', G1 ='".$data['G1']."', G2 ='".$data['G2']."', H1 ='".$data['H1']."', H2 ='".$data['H2']."' WHERE UserId = '".$uid."'";				
	}

	if (!mysqli_query($con,$sql)) {
	  die('Error: ' . mysqli_error($con));
	}

	foreach($data as $key => $val){
		$_SESSION[$key] = $val;		
	}

	header("Location: http://www.gpm2014.tk#download");
	mysqli_close($con);
?>