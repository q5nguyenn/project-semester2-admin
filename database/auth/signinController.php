<?php
require_once '../database.php';
require_once '../utility.php';

if (!empty(checkLogin())) {
	header("Location: ../../views/index.php");
}

$email = getPOST('email');
$password = getPOST('password');
$remember = getPOST('remember');
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$error = '';
session_start();
$_SESSION['email'] = $email;

$sql = "SELECT * FROM `users` WHERE email = '$email'";
$user = excuteResult($sql, true);
if (empty($user)) {
	$_SESSION['error'] = '*Tài khoản không tồn tại.';
	header("Location: ../../views/auth/signin.php");
} else {
	if (password_verify($password, $user['password'])) {
		$_SESSION['user'] = $user;
		if ($remember == 1) {
			$remember_token =  bin2hex(random_bytes(32));
			$sql = "UPDATE users SET remember_token = '" . $remember_token . "' WHERE id = '" . $user['id'] . "'";
			excute($sql);
			setcookie('remember_token', $remember_token, time() + 120, '/');
			setcookie('id', $user['id'], time() + 120, '/');
		} else {
			setcookie('remember_token', $remember_token, time(), '/');
			setcookie('id', $user['id'], time(), '/');
		}
		header("Location: ../../views/index.php");
	} else {
		$_SESSION['error'] = '*Mật khẩu không hợp lệ.';

		// Điều hướng trở về trang đăng nhập
		header("Location: ../../views/auth/signin.php");
		exit();
	}
}
