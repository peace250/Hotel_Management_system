<?php
include('../db/conn.php');
if($_SERVER['REQUEST_METHOD'] ==="POST" && isset($_post['add'])){
    $name = htmlspecialchars($_post['name']);
    $file = $_FILES['image'];

    $fileTmpname = $file['tmp_name'];
    $filesize = $file['size'];
    $filerror = $file['error'];
    $fileType = $file['type'];
    $sql = "INSERT INTO peace (name,image) values ('$name','$imageJson')";

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<button class="bg-dark text-white " data-bs-target ="#edit_airbnbModal" data-bs-toggle="modal">click me</button>
 

</body>
</html>