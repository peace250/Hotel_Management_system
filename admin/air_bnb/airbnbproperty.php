<?php
require('../db/conn.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = floatval($_POST['price']);
        $street = htmlspecialchars($_POST['street']);
        $city  = htmlspecialchars($_POST['city']);
        $country  = htmlspecialchars($_POST['country']);
        $rooms  = intval($_POST['number_of_bedrooms']);
        $bathrooms  = intval($_POST['number_of_bathrooms']);
        $guests  = intval($_POST['max_guests']);
        $rules  = intval($_POST['house_rules']);

       // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = '../uploads'; // Directory to store uploaded images
        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath = $uploadDir . '/' . $imageName; // Full path
        $dbImagePath = 'uploads/' . $imageName; // Relative path for database storage
        // Move the uploaded file to the target directory
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            die("Error uploading the image. Check folder permissions.");
        }
    } else {
        die("No image uploaded or an error occurred.");
    }


    // Insert data into the database
    $insert_property = "INSERT INTO  airbnb_properties
        (name, description,property_type, price_per_night, image,max_guests,amenities,status,street,country,city,number_of_bedrooms,number_of_bathrooms) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $insert_property);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssdssssssdd", $name, $description, $type, $price, $dbImagePath, $max_guests, $amenitiesJson, $status,$street,$country,$city,$rooms,$bathrooms);
        if (mysqli_stmt_execute($stmt)) {
            echo "
            <script>alert('New Property Added successfully!');
            </script>
            ";
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Statement Preparation Error: " . mysqli_error($conn);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#f2f2f2">
    <!-- container  -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <!-- nav-part -->
            <div class="col-sm-2">
                <?php require('../navbar/nav.php') ?>
            </div>
            <!-- display right -->
            <div class="col-sm-10 ms-auto ">
                <div class="row">
                    <?php require('../navbar/main_nav.php') ?>
                </div>
                <div class="row mt-5 ">
                    <div class="col-sm-3  me-auto">
                        <!-- form modal to add rooms -->
                      <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title text-uppercase fw-bold " id="propertyModalLabel" style="width: fit-content; color:#031c3f">Add Property</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="property.php" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="name" class="form-control" placeholder="Property Title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control" rows="3" placeholder="Enter description"></input>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input type="text" name="country" class="form-control" rows="3" placeholder="Enter description"></input>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Street</label>
                                                <input type="text" name="street" class="form-control" rows="3" placeholder="Enter description"></input>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Price ($)</label>
                                                <input type="number" name="price" class="form-control" placeholder="Enter price" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Max_Guests</label>
                                                <input type="number" name="guests" class="form-control" placeholder="Number of people" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bed rooms</label>
                                                <input type="number" name="rooms" class="form-control" placeholder="Number of people" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bath rooms</label>
                                                <input type="number" name="bathrooms" class="form-control" placeholder="Number of people" required>
                                            </div>
                                            <!-- Status -->
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="available">Available</option>
                                                    <option value="booked">Booked</option>
                                                    <option value="maintenance">Maintenance</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Property Type</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="apartment">Apartment</option>
                                                    <option value="house">House</option>
                                                  
                                                </select>

                                            </div>

                                            <!-- Amenities -->
                                            <div class="form-group">
                                                <label>Amenities</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="wifi" name="amenities[]" value="wifi">
                                                    <label class="form-check-label" for="wifi">Wi-Fi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="pool" name="amenities[]" value="pool">
                                                    <label class="form-check-label" for="pool">Pool</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="parking" name="amenities[]" value="parking">
                                                    <label class="form-check-label" for="parking">Parking</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="pets_allowed" name="amenities[]" value="pets_allowed">
                                                    <label class="form-check-label" for="pets_allowed">Pets Allowed</label>
                                                </div>
                                            </div>
                                            <!-- upload image -->
                                            <div class="mb-3">
                                                <label class="form-label">Image Filename</label>
                                                <input type="file" name="image" class="form-control" placeholder="e.g., property.jpg">
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" name="add" class="btn text-light" style="background-color:  #031c3f;;">+ ADD property</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of form modal codes -->

                    </div>
                </div>
                <div class="col-sm-9 me-auto ">

                    <!-- table to display the properties -->


                    <div class="container mt-5">
                        <div class="d-flex justify-content-between mb-4">
                            <h3>Manage Properties</h3>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#propertyModal">+ Add New Property</button>


                        </div>
                        <div class="row">
                            <?php

                            $sql_select = "SELECT * FROM airbnb_properties";
                            $sql_run = mysqli_query($conn, $sql_select);

                            if (mysqli_num_rows($sql_run) > 0) {
                                while ($row = mysqli_fetch_assoc($sql_run)) {
                                    echo '<div class="col-md-4 mb-4">';
                                    echo '    <div class="card shadow-sm">';
                                    echo '        <img src="../' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="Property Image" style="height: 200px; object-fit: cover;">';
                                    echo '        <div class="card-body">';
                                    echo '            <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                                    echo '            <p class="fw-bold">$' . htmlspecialchars($row['price']) . ' per night</p>';
                                    echo '            <p class="fw-bold">Capacity: ' . htmlspecialchars($row['capacity']) . ' people</p>';
                                    echo '            <p>Status: <span class="badge bg-' . ($row['status'] == 'available' ? 'success' : 'warning') . '">' . htmlspecialchars($row['status']) . '</span></p>';
                                    echo '            <div class="d-flex justify-content-between">';
                                    echo '                <a href="property.php?id=' . $row['id'] . '" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editpropertyModal" name= "edit">Edit</a>';
                                    echo '                <a href="property.php?id=' .$row['id'] . '" class="btn btn-danger" onclick="return confirm(`Are you sure?`)">Delete</a>';
                                    echo '            </div>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p class="text-center">No properties found.</p>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <!-- row end -->
    </div>

</body>
</html>