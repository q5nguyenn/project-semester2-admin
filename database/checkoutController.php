<?php
session_start();
require_once 'database.php';
require_once 'utility.php';

$user = checkLogin();
if (!empty($user)) {
	$sql = "INSERT INTO `bills` ( `user_id`, `created_at`, `updated_at`) 
	VALUES ('" . $user['id'] . "', NOW(), NOW())";
	$bill_id =  excute($sql);
	$sql = "SELECT * FROM carts where user_id = '" . $user['id'] . "'";
	$carts = excuteResult($sql);
	foreach ($carts as  $cart) {
		$sql = "INSERT INTO `bill_course` (`bill_id`, `course_id`, `created_at`, `updated_at`) 
		VALUES ('" . $bill_id . "', '" . $cart['course_id'] . "', NOW(), NOW())";
		excute($sql);
	}
	header("Location: " . asset('views/dash-board/dashboard.php'));
}
