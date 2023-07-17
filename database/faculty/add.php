<?php 
session_start();
include '../database.php';
include '../utility.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $khoahoc = getPOST('name');
    $icon = getPOST('icon');

    // Kiểm tra dữ liệu có hợp lệ hay không (nếu cần)

    $sql = "INSERT INTO `faculties` (`name`, `icon`) VALUES ('$khoahoc', '$icon')";
   $result = excuteResult($sql);

   if ($result) {
    if (!headers_sent()) {
        header("Location: ../faculty.php");
        exit();
    } else {
        echo '<script>window.location.href = "../faculty.php";</script>';
        exit();
    }
}


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container fw-bold">
        <form action="" method="POST">
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">name:</label>
            <input type="text" class="form-control" id="name" placeholder="Khoá học" name="name">
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Icon:</label>
            <input type="text" class="form-control" id="icon" placeholder="Icon" name="icon">
        </div>
        <button type="submit" class="btn btn-danger">Save</button>
        </form>
    </div>

</body>
</html>