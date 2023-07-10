<?php
require_once 'config.php';
function openConnection()
{
	$conn = new mysqli(SERVERNAME, USER_NAME, PASSWORD, DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

function closeConnection($conn)
{
	$conn->close();
}

// 
function excute($sql)
{
	$conn = openConnection();
	$conn->query($sql);
	return $conn->insert_id;
	closeConnection($conn);
}

// 
function excuteResult($sql, $first = false)
{
	$data = [];
	$conn = openConnection();
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	} else {
		return false;
	}
	if ($first == true) {
		$data = reset($data);
	}
	closeConnection($conn);
	return $data;
}


function checkLogin()
{
	if (isset($_COOKIE['remember_token']) && !empty($_COOKIE['remember_token'])) {
		$remember_token = $_COOKIE['remember_token'];
		$id =  $_COOKIE['id'];
		$sql = "SELECT * FROM `users` WHERE id = '" . $id . "' AND remember_token = '" . $remember_token . "'";
		$user = excuteResult($sql, true);
		if (count($user) > 0) {
			return $user;
		} else {
			return null;
		}
	} else if (isset($_SESSION['user'])) {
		return  $_SESSION['user'];
	}
	return null;
}
