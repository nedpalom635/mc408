<?php		
	//start a session
	session_start();
	
	//require "Connection.php";
	//$connection = new Connection();
	//connection string
	$server = "localhost";
	$dbname = "version1_6";
	$user = "root";
	$pass = "";
	
	//create connection to the database on the server
	$connection = mysqli_connect($server,$user,$pass,$dbname);
	
	// Check connection
	if (mysqli_connect_errno()){
		die ("Failed to connect to MySQL: " . mysqli_connect_error());
	}

	//retrieve the values from the login form and store them in variables
	$username = $_GET['username'];
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	//setup the sql statement
	//$usersSQL = "INSERT INTO customers (username, email, password) VALUES ('$username', '$email', '$password')";
	$usersSQL = "INSERT INTO customers (username, password, email) VALUES ('$username', '$email', '$password')";

	
	
	//execute sql statement and store results in a variable
	$userDetails = mysqli_query($connection,$usersSQL);
		  
	//check if first row is not null
	//$row = mysqli_fetch_array($userDetails);
	
	mysqli_close($connection);
	
	//if login is successful, store the user's fullname in a session
	if($userDetails <> null){
		//$fullname = $row['firstname'] . " " . $row['lastname'];
		//$_SESSION["fullname"] = $fullname;
		//$_SESSION["customerID"] = $row['customer_id'];
		$_SESSION["name"] = $row['username'];
		$_SESSION["customerID"] = $row['customer_id'];

		header("Location: Homepage/Homepage.php");
	}
	
	//if login not successful, redirect user to loginForm.html
	else{
		header("Location: index.html");
	}
	//close connection
	mysqli_close($connection);
?>