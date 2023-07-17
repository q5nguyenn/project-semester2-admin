<?php
session_start();
include '../database.php';
include '../utility.php';

echo'1';
die();
$id = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = getPOST('id');

    $sql = "DELETE FROM `faculties` WHERE id = '$id'";
    $result = excuteResult($sql, true);
    if ($result) {
        echo ' loi ';
        exit();
    }else{
        echo'da xoa thanh cong';
        header("Location: ../../faculty.php");
        exit();
    }
}
?>
