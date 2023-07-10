<?php
session_start();
require_once '../database.php';
require_once '../utility.php';
$user = checkLogin();
$target_dir = "../../public/storage";
$fileName = time() . '_' . basename($_FILES["thumbnail"]["name"]);
$target_file = $target_dir . $fileName;
print_r($_FILES);
die();
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}

// Check file size
if ($_FILES["thumbnail"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

// Allow certain file formats
if (
	$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif"
) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
		echo "The file " . htmlspecialchars(basename($_FILES["thumbnail"]["name"])) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
// $thumbnail = $target_file;
// $sql = "UPDATE users SET thumbnail = '" . $thumbnail . "' WHERE id = '" . $user['id'] . "'";
// excute($sql);
