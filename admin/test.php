
<?php
require('../db/conn.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Collect form data
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $country = htmlspecialchars(trim($_POST['country']));
    $type = htmlspecialchars(trim($_POST['type']));
    $price = htmlspecialchars(trim($_POST['price']));
    $availability = htmlspecialchars(trim($_POST['availability']));
    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $imageTmpPath = $_FILES['image']['tmp_name'];
        
        $imageName = basename($_FILES['image']['name']);
        
        $uploadDir = '../uploads'; // Directory to store uploaded images
        
        $imagePath = $uploadDir . '/' . $imageName;
        
        // Move the uploaded file to the target directory
        
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            die("Error uploading the image.");
        }
    } else {
        die("No image uploaded or an error occurred.");
    }
    // Insert data into the database
    $insert_property = "INSERT INTO properties
     (name, description, address,
     city, country, type,
      price,
      image, availability) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = mysqli_prepare($conn, $insert_property);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssdss", $name, $description, $address, $city, $country, $type, $price, $imagePath, $availability);
        if (mysqli_stmt_execute($stmt)) {
            echo "Property added successfully!";
        } else {
            echo "Error:" . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
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
    <div class="container-fluid d-flex flex-row bg-white ">
        <!-- <div class="left col-sm-2 col-md-3 col-lg-1 left_element  h-100" style="position: fixed;">
        </div> -->
        <div class="right col-sm-10 col-md-10 col-lg-10  p-4 ms-auto mb-auto" style="background-color:#f2f2f2;height:100vh;">
            <div class="row">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#propertyModal" style="width: fit-content;">
                    Add Property +
                </button>
                <!-- Modal -->
                <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="propertyModalLabel">Add Property</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Property Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" name="city" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" name="country" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Property Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="hotel">Hotel</option>
                                            <option value="airbnb">Airbnb</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price per Night ($)</label>
                                        <input type="number" step="0.01" class="form-control" name="price" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Availability</label>
                                        <select name="availability">
                                            <option value="" disabled selected></option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Image</label>
                                        <input type="file" step="0.01" class="form-control" name="image" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Add Property</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- dashboard's content -->
            <!-- view available properties and edit them -->
            <table class="table w-50">

                <tbody>
                    <?php
                    $sql_select = "SELECT * FROM properties where type='airbnb'";
                    $sql_run = mysqli_query($conn, $sql_select);

                    while (mysqli_num_rows($sql_run) > 0) {
                        echo "
                            <thead>            
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>address</th>
                            <th>city</th>
                            <th>country</th>
                            <th>type</th>
                            <th>Availability</th>
                            <th>Image</th>
                        </tr>
                        </thead> 
                        ";
                        $row = mysqli_fetch_assoc($sql_run);
                        echo "
       
                    <tr>

                          <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['country']}</td>
                    <td>{$row['type']}</td>
                    <td>" . ($row['availability'] == 'true' ? 'Yes' : 'No') . "</td>
                    <td><img src='{$row['image']}' alt='Property Image' style='width: 120px; height: auto;'></td>
                </tr>
                    
            
                    
                    ";
                    }



                    ?>
                </tbody>
            </table>
        </div>



    </div>
</body>

</html>