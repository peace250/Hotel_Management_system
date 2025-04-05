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
        $uploadDir = './uploads/'; // Directory to store uploaded images
        $imagePath = $uploadDir . '/' . $imageName; // Full path
        $dbImagePath = 'uploads/'.$imageName; // Relative path for database storage
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

                        <?php
                        $sql_select = "SELECT * FROM hotel_rooms";
                        $sql_run = mysqli_query($conn, $sql_select);
                        echo '<table class="table table-bordered">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Image</th>';
                        echo '<th>Name</th>';
                        echo '<th>Price per Night</th>';
                        echo '<th>Capacity</th>';
                        echo '<th>Status</th>';
                        echo '<th>Actions</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        if (mysqli_num_rows($sql_run) > 0) {
                            while ($row = mysqli_fetch_assoc($sql_run)) {

                                echo '<tr>';
                                echo '<td><img src="./' . htmlspecialchars($row['image']) . '" alt="Property Image" style="width:100px; height:80px; object-fit:cover;"></td>';
                                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                echo '<td>$' . htmlspecialchars($row['price']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['capacity']) . ' people</td>';
                                echo '<td><span class="badge bg-' . ($row['status'] == 'available' ? 'success' : 'warning') . '">' . htmlspecialchars($row['status']) . '</span></td>';
                                echo '<td>';
                                echo '
          <!-- edit button area: -->
                    <button class="btn btn-warning edit-btn"
                     data-bs-toggle="modal"
                     data-bs-target="#editpropertyModal"
                     data-id="' . $row['id'] . '"
                     data-name="' . htmlspecialchars($row['name']) . '"
                     data-description="' . htmlspecialchars($row['description']) . '"
                     data-price="' . htmlspecialchars($row['price']) . '"
                     data-capacity="' . htmlspecialchars($row['capacity']) . '"
                     data-status="' . htmlspecialchars($row['status']) . '"
                     data-type="' . htmlspecialchars($row['type']) . '"
                     data-amenities="' . htmlspecialchars($row['amenities']) . '"
                     data-image="'.htmlspecialchars($row['image'],ENT_QUOTES).'">
                     Edit
                                                    </button>
        
        
                                                

                                                  
<button class="btn btn-danger delete-btn " name="delete"
data-id="' . $row['id'] . '"
data-bs-target="#deletepropertyModal"
data-bs-toggle="modal">
Delete
</button>';
                            }
                        } else {
                            echo '<p class="text-center">No properties found.</p>';
                        }
                        ?>

                        <!-- row end -->
                    </div>
                    <!-- Update area php codes-->
                    <?php
                    if (isset($_POST['edit'])) {
                        // Get input values
                        $id = $_POST['id'];
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $description = mysqli_real_escape_string($conn, $_POST['description']);
                        $price = floatval($_POST['price']); // Convert to float
                        $capacity = intval($_POST['capacity']); // Convert to integer
                        $status = mysqli_real_escape_string($conn, $_POST['status']);
                        $type = mysqli_real_escape_string($conn, $_POST['type']);

                        // Handle amenities
                        $amenities = isset($_POST['amenities']) ? json_encode($_POST['amenities']) : json_encode([]);

                        // Check if a new image is uploaded
                        if (!empty($_FILES['image']['name'])) {
                            $targetDir = 'uploads/';

                            $fileName = basename($_FILES["image"]["name"]);
                            $targetFilePath = $targetDir.$fileName;

                            // Check file type
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                            if (in_array(strtolower($fileType), $allowedTypes)) {
                               
                                // if (!is_dir($targetDir)) {
                                //     mkdir($targetDir, 0755, true);
                                // }

                                // Move the uploaded file
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                                    $image = $targetFilePath; // Save new image path
                                } else {
                                    echo "<script>alert('Error uploading the image. Please try again later.'); 
                    window.history.back();</script>";
                                    exit();
                                }
                            } else {
                                echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
                 window.history.back();</script>";
                                exit();
                            }
                        } else {
                            // Keep the existing image
                            if (!empty($_POST['existing_image'])) {
                                $image = mysqli_real_escape_string($conn, $_POST['existing_image']);
                            } else {
                                echo 'No image provided!';
                            }
                        }

                        // Prepare the SQL statement
                        $query = "UPDATE hotel_rooms SET name = ?, description = ?, price = ?, capacity = ?, status = ?, type = ?, amenities = ?, image = ? WHERE id = ?";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "ssdissssi", $name, $description, $price, $capacity, $status, $type, $amenities, $image, $id);
                        // Execute the query
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Property updated successfully!');
             window.location.href='property.php';</script>";
                        } else {
                            echo "<script>alert('Update failed: " . mysqli_stmt_error($stmt) . "');</script>";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }

                    ?>








                    <!-- form modal to edit rooms -->
                    <div class="modal fade" id="editpropertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title text-uppercase fw-bold " id="propertyModalLabel" style="width: fit-content; color:#031c3f">Edit Property</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="property.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="editId">

                                        <div class="mb-3">
                                            <label class="form-label">Room Name</label>
                                            <input type="text" name="name" class="form-control" id="editName">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" id="editDescription"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Price ($)</label>
                                            <input type="number" name="price" class="form-control" id="editPrice">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Capacity</label>
                                            <input type="number" name="capacity" class="form-control" id="editCapacity">
                                        </div>

                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="editStatus" name="status">
                                                <option value="available">Available</option>
                                                <option value="booked">Booked</option>
                                                <option value="maintenance">Maintenance</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <select class="form-control" id="editType" name="type">
                                                <option value="single">Single</option>
                                                <option value="double">Double</option>
                                                <option value="suite">Suite</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Amenities</label>
                                            <div id="editAmenities">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="wifi" id="wifi">
                                                    <label class="form-check-label" for="wifi">WiFi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="pool" id="pool">
                                                    <label class="form-check-label" for="pool">Pool</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="parking" id="parking">
                                                    <label class="form-check-label" for="parking">Parking</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="pets_allowed" id="pets_allowed">
                                                    <label class="form-check-label" for="pets_allowed">Pets Allowed</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="existingImageInput" name="existing_image">
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control" id="editImage">
                                            <small class="form-text text-muted">Current Image: <img src="" id="existingImage"  name="existing_image" width="100"></small>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" name="edit" class="btn text-light" style="background-color: #031c3f;">Update Property</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- delete a room model -->
                    <?php
                    // delete section area(php codes)
                    if (isset($_POST['delete'])) {
                        $id = intval($_POST['id']);
                        //retrieve the image path before deleting the record
                        $select_query = "SELECT image FROM hotel_rooms WHERE id = ? ";
                        $stmt = mysqli_prepare($conn, $select_query);
                        mysqli_stmt_bind_param($stmt, "i", $id);
                        mysqli_stmt_execute($stmt);
                        // binding image result
                        mysqli_stmt_bind_result($stmt, $image);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);
                        // delete image from DB

                        if (!empty($image) && file_exists("../" . $image)) {
                            unlink("../" . $image);
                        } else {
                            error_log("file not found:" . $file_path);
                        }

                        // delete query
                        $deleteQuery = "DELETE FROM hotel_rooms WHERE id = ?";
                        $stmt = mysqli_prepare($conn, $deleteQuery);
                        mysqli_stmt_bind_param($stmt, "i", $id);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('property deleted successully');
    window.location.href = 'property.php';
    </script>";
                            exit();
                        } else {
                            echo "<script>alert('Error deleting property:" . mysqli_error($conn) . "');</script>";
                        }
                    }

                    ?>
                    <div class="modal fade" id="deletepropertyModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete property</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                </div>
                                <div class="modal-body text-center">
                                    <b>
                                        <h4>Are you sure you want to delete this property?</h4>
                                    </b>
                                </div>
                                <div class="modal-footer">
                                    <form action="property.php" method="POST" class="d-flex flex-column">
                                        <input type="hidden" name="id" id="deleteId">
                                        <button type="submit" name="delete" class="btn btn-danger" style="align-self: center;">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary ms-auto" data-bs-dismiss="modal">cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                  
                       

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                   <script src="./js/script.js"></script>
                    <!-- End of form modal codes -->
</body>
</html>