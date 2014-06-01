<?php
	$mysql_host = "mysql1.000webhost.com";
	$mysql_database = "a3120811_gpm";
	$mysql_user = "a3120811_plleras";
	$mysql_password = "Canada2654";
	$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// escape variables for security

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
	$pass = mysqli_real_escape_string($con, $_POST['pass']);

	$password = md5($pass);

	$sql="INSERT INTO Users (FirstName, LastName, Email, Password)
	VALUES ('$firstname', '$lastname', '$email', '$password')";

	if (!mysqli_query($con,$sql)) {
		echo "<script type='text/javascript'>alert('el email que usted ha elegido ya existe');
				window.location='http://www.gpm2014.tk';
			  </script>";
	  //die('Error: ' . mysqli_error($con));
	} else{
		header("Location: http://www.gpm2014.tk");
	}

	mysqli_close($con);
?>