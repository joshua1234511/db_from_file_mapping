<?php 
	
	define('FILES_PATH', __DIR__ . '/downloads/');

	// Data base Configuration
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "owlshares_etf";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}