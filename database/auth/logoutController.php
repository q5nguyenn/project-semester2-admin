<?php
session_start();
session_destroy();
setcookie('remember_token', '', time(), '/');
setcookie('id', '', time(), '/');
header('Location: ' . $_SERVER['HTTP_REFERER']);
