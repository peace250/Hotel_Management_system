<?php
require('../db/conn.php');
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add'])) {
    // Collect form data
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $capacity = intval($_POST['capacity']);
    // Handle amenities
    $amenitiesArray = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : [];
    $sanitizedAmenities = array_map('htmlspecialchars', $amenitiesArray);
    $amenitiesJson = json_encode($sanitizedAmenities);
    $status = htmlspecialchars(trim($_POST['status']));
    $type = htmlspecialchars(trim($_POST['type']));
    $price = floatval($_POST['price']);
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
    $insert_property = "INSERT INTO  hotel_rooms
        (name, description,`type`, price, image,capacity,amenities,status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_property);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssdssss", $name, $description, $type, $price, $dbImagePath, $capacity, $amenitiesJson, $status);
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
                <?php require('../navbar/sidenav.php') ?>
            </div>
            <!-- display right -->
            <div class="col-sm-10 ms-auto ">
                <div class="row">
                    <?php require('../navbar/nav.php') ?>
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
                                                <label class="form-label">Room Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter property name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Price ($)</label>
                                                <input type="number" name="price" class="form-control" placeholder="Enter price" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Capacity</label>
                                                <input type="number" name="capacity" class="form-control" placeholder="Number of people" required>
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
                                                <label class="form-label">Type</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="single">Single</option>
                                                    <option value="double">Double</option>
                                                    <option value="suite">Suite</option>
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
                                                <button type="submit" name="add" class="btn text-light" style="background-color:  #031c3f;;">+ ADD ROOM</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of form modal codes -->

                    </div>
                </div>
                <div class="col-sm-12 me-auto  ">




                    <div class="container mt-5 ">
                        <div class="d-flex justify-content-between mb-4">
                            <h3 class="fw-bold" style="color:#031c3f">Manage Properties</h3>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#propertyModal">+ Add New Property</button>


                        </div>
                        <div class="row ">
                            <?php

                            $sql_select = "SELECT * FROM hotel_rooms";
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

                                    echo '          <button class="btn btn-warning"name="edit"   data-bs-target="#editpropertyModal" data-bs-toggle="modal"><a href="property.php?id=' . $row['id'] . '">Edit</a></button>  ';
                                    // echo '<a href="property.php" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editpropertyModal" name="edit" data-id="'.$row['id'].'">Edit</a>';
                                    
                                    echo '               ';
                                    echo '<button class="btn btn-danger" onclick="return confirm(`Are you sure?`)" name = "delete"> <a href="property.php?id='.$row['id'].'" >Delete</a></button>';
                                    
                                  
                                  
                                  
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
    <!-- Update area -->
   




    <?php require('./editproperty.php') ?>
    <?php require('./deleteproperty.php') ?>
    <!-- form modal to edit rooms -->
    <div class="modal fade" id="editpropertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-uppercase fw-bold " id="propertyModalLabel" style="width: fit-content; color:#031c3f">Edit Property</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="property.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter property name" required value="<?php echo htmlspecialchars($fetch['name']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description" <?php echo htmlspecialchars($fetch['description']) ?>></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price" required value="<?php echo htmlspecialchars($fetch['price']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacity</label>
                            <input type="number" name="capacity" class="form-control" placeholder="Number of people" required value="<?php echo htmlspecialchars($fetch['capacity']) ?>">
                        </div>
                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="available"
                                    <?php echo  $fetch['status'] === 'available' ? 'selected' : ''; ?>> Available</option>
                                <option value="booked"
                                    <?php echo $fetch['status'] === 'Booked' ? 'selected' : '' ?>>Booked</option>
                                <option value="maintenance"
                                    <?php echo $fetch['status'] === 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <?php echo $fetch['type'] === 'single' ? 'selected' : ''; ?>
                                <option value="single">Single</option>
                                <?php echo $fetch['type'] === 'double' ? 'selected' : ''; ?>
                                <option value="double">Double</option>
                                <?php echo $fetch['type'] === 'suite' ? 'selected' : ''; ?>
                                <option value="suite">Suite</option>
                            </select>

                        </div>

                        <!-- Amenities -->
                        <div class="form-group">
                            <label>Amenities</label>
                            <?php
                            $amenities = json_decode($fetch['amenities'], true);
                            $amenitiesList = ['wifi', 'pool', 'parking', 'pets_allowed'];
                            foreach ($amenitiesList as $amenity) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" name="amenities[]" value="' . $amenity . '" ' . (in_array($amenity, $amenities) ? 'checked' : '') . '>';
                                echo '<label class="form-check-label">' . ucfirst(str_replace('_', ' ', $amenity)) . '</label>';
                                echo '</div>';
                            }
                            ?>


                        </div>
                        <!-- upload image -->
                        <div class="mb-3">
                            <label class="form-label">Image Filename</label>
                            <input type="file" name="image" class="form-control" placeholder="e.g., property.jpg">
                            <?php if ($fetch['image']): ?>
                                <small class="form-text text-muted">Current Image: <img src="../<?php echo $fetch['image']; ?>" alt="Current Image" width="100"></small>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="edit" class="btn text-light" style="background-color:  #031c3f;">Update Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of form modal codes -->
</body>

</html>