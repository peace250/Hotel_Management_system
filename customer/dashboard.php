<?php
require('../db/conn.php');



if($_SERVER['REQUEST_METHOD']==="POST"){
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$status = $_POST['status'];
$total_price = $_POST['status'];
$created_at = $_POST['created at'];
$property_id = $_POST['propery_id'];
$user_id = $_POST['user_id'];
$id = $_POST['id']; // book id
}






















?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="" style="background-color:#f2f2f2">
    <div class="container-fluid d-flex flex-row bg-white">

    <div class="left col-sm-2 col-md-3 col-lg-1 left_element fixed-top h-100">
    <?php require('./nav.php')?>
    </div>
        <div class="right col-sm-10 col-md-10 col-lg-10  p-4 ms-auto" style="background-color:#f2f2f2;  height:150vh;">
            <div class="header bg-white p-5 w-75" style="box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2); border-radius:20px">
                <h4 class="fw-bold text-primary">Want a room and and a perfect relaxation session with family?</h4>
                <form action="#" class=" d-flex gap-3" method="POST">
                    <label for="check_in" class="input-label fw-bold text-light">Check_In:</label>
                    <input type="date" class="form-control w-25">
                    <label for="check_out" class="input-label fw-bold text-light">Check_Out:</label>
                    <input type="date" class="form-control w-25">
                    <button class="btn bg-primary fw-bold text-white">Check Availability!</button>
                </form>
            </div>

          
            <div class="container bg-white col-sm-10 p-3 mt-3 " style="box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">



<table>
    <?php
$sql = "SELECT * FROM PROPERTIES INNER JOIN BOOKINGS WHERE PROPERTIES.id = Bookings.property_id";

$runQuery = mysqli_query($conn,$sql);
if (mysqli_num_rows($runQuery) > 0) {
    echo "
    <thead>
      <th>Image</th>
      <th>Name</th>
      <th>Description</th>
      <th>Address</th>
      <th>City</th>
      <th>Country</th>
      <th>Type</th>
      <th>Price</th>
      <th>Availability</th>
</thead> 
  ";
    while ($row = mysqli_fetch_assoc($sql_run)) {
        echo "<tbody>";
        echo "<tr>";
        echo "<td><img src='../" . htmlspecialchars($row['image']) . "' alt='Property Image' style='width: 120px; height: auto;'></td>";
        echo "<td> <b>" . $row['name'] . "</b></td>";
        echo "<td class='p-3'>" . $row['description'] . "</td>";
        echo "<td class='p-3'>" . $row['address'] . "</td>";
        echo "<td class='p-3'>" . $row['city'] . "</td>";
        echo "<td class='p-3'>" . $row['country'] . "</td>";
        echo "<td class='p-3'>" . $row['type'] . "</td>";
        echo "<td class='p-3'>" . $row['price'] . "</td>";
        echo  "<td class='p-3'>" . ($row['availability'] == 'true' ? 'Yes' : 'No') . "</td>";
        echo "</tr>";
        echo  "</tbody>";
    }
} else {
    echo "<tr><td colspan='10'>No properties found.</td></tr>";
}

    ?>
</table>










   





















        </div>
    </div>
    <style>

    </style>
</body>

</html>