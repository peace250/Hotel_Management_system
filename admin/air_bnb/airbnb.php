<?php
require('../db/conn.php');
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add'])) {
    // Collect form data
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $status = htmlspecialchars(trim($_POST['status']));
    $type = htmlspecialchars(trim($_POST['type']));
    $price = floatval($_POST['price']);
    $rules = htmlspecialchars(trim($_POST['rules']));
    $rooms = intval($_POST['rooms']);
    $bathrooms = intval($_POST['bathrooms']);
    $guests = intval($_POST['guests']);
    $address = htmlspecialchars($_POST['address']);
    // Handle amenities
    $amenitiesArray = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : [];
    $sanitizedAmenities = array_map('htmlspecialchars', $amenitiesArray);
    $amenitiesJson = json_encode($sanitizedAmenities);
    // Handle the photos upload
    $photos = "";
    if (isset($_FILES['photos']) && !empty($_FILES['photos']['name'][0])) {
        $photo_paths = [];
        $upload_dir = __DIR__ . "/uploads";
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            if (!empty($_FILES['photos']['name'][$key])) {
                $file_name = basename($_FILES['photos']['name'][$key]);
                $target_file = $upload_dir . '/' . $file_name;

                if (move_uploaded_file($tmp_name, $target_file)) {
                    $photo_paths[] = "uploads/" . $file_name;
                } else {
                    echo "error moving file" . $_FILES['photos']['name'][$key];
                }
            }
        }
        $photosJson = json_encode($photo_paths);
    } else {
        $photos = "[]";
    }



    // Insert data into the database
    $insert_property = "INSERT INTO  airbnb_properties
        (name, description, price_per_night, number_of_bathrooms, max_guests, amenities, house_rules, status, photos, property_type, number_of_bedrooms,address) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_property);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdiisssssss", $name, $description, $price, $bathrooms, $guests, $amenitiesJson, $rules, $status, $photosJson, $type, $rooms, $address);
        if (mysqli_stmt_execute($stmt)) {
            echo "
            <script>alert('New Property Added successfully!');
            window.location.href = 'airbnb.php';
            </script>
            ";
            exit();
        } else {
            die("Database Error:" . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt);
    } else {
        die("Statement Preparation Error:" . mysqli_error($conn));
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


                        <!-- Bootstrap Modal -->
                        <div class="modal fade" id="airbnbModal" tabindex="-1" aria-labelledby="airbnbModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="airbnbModalLabel">Add Airbnb Property</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="propertyForm" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Property Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address">
                                            </div>



                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price (USD)</label>
                                                <input type="number" class="form-control" name="price" required min="0">
                                            </div>

                                            <div class="mb-3">
                                                <label for="number_of_bathrooms" class="form-label">Bathrooms</label>
                                                <input type="number" class="form-control" name="bathrooms" min="0">
                                            </div>

                                            <div class="mb-3">
                                                <label for="max_guests" class="form-label">Max Guests</label>
                                                <input type="number" class="form-control" name="guests" required min="1">
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

                                            <div class="mb-3">
                                                <label for="house_rules" class="form-label">House Rules</label>
                                                <textarea class="form-control" name="rules"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="" disabled selected></option>
                                                    <option value="available">Available</option>
                                                    <option value="booked">Booked</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="property_type" class="form-label">Property Type</label>
                                                <select type="text" class="form-control" name="type">
                                                    <option value="" disabled selected></option>
                                                    <option value="apartment">Apartment</option>
                                                    <option value="apartment">House</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rooms" class="form-label">Number of Rooms</label>
                                                <input type="number" class="form-control" name="rooms" required min="1">
                                            </div>

                                            <div class="mb-3">
                                                <label for="photos" class="form-label">Photos</label>
                                                <input type="file" class="form-control" name="photos[]" multiple accept="image/*">
                                            </div>
                                            <button type="submit" class="btn btn-success" name="add">Save Property</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of form modal codes(airbnb_properties) -->
                    </div>
                </div>


                <div class="col-sm-12 me-auto  ">
                    <div class="container mt-5 ">
                        <div class="d-flex justify-content-between mb-4">
                            <h3 class="fw-bold" style="color:#031c3f">Manage Properties</h3>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#airbnbModal">+ Add New Property</button>
                        </div>



                        <!-- Display recordered properties -->
                        <div class="col-sm-12 me-auto  ">
                            <div class="container mt-5 ">
                                <?php
                                $sql_select = "SELECT * FROM airbnb_properties";
                                $sql_run = mysqli_query($conn, $sql_select);
                                echo '<table class="table table-bordered">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Image</th>';
                                echo '<th>Name</th>';
                                echo '<th>Price per Night</th>';
                                echo '<th>Guests</th>';
                                echo '<th>Address</th>';
                                echo '<th>type</th>';
                                echo '<th>Status</th>';
                                echo '<th>Actions</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                if (mysqli_num_rows($sql_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($sql_run)) {
                                        // Decode JSON photos column
                                        $photos_array = json_decode($row['photos'], true);
                                        $first_image =  (!empty($photos_array) && is_array($photos_array)) ? $photos_array[0] : "7.jpg";
                                        echo '<tr>';
                                        echo '<td><img src="./' . htmlspecialchars($first_image) . '"alt="Property Image" style="width:100px; height:80px; object-fit:cover;"></td>';
                                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                        echo '<td>$' . htmlspecialchars($row['price_per_night']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['max_guests']) . 'people</td>';
                                        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['property_type']) . '</td>';
                                        echo '<td><span class="badge bg-' . ($row['status'] == 'available' ? 'success' : 'warning') . '">' . htmlspecialchars($row['status']) . '</span></td>';
                                        echo '<td>';
                                        echo '
          <!-- edit button area: -->
                    <button class="btn btn-warning update-btn" name ="update"
                     data-bs-toggle="modal"
                     data-bs-target="#edit_airbnbModal"
                     data-id="' . $row['id'] . '"
                     data-name="' . htmlspecialchars($row['name']) . '"
                     data-description="' . ($row['description']) . '"
                     data-price="' . htmlspecialchars($row['price_per_night']) . '"
                     data-address="' . htmlspecialchars($row['address']) . '"
                     data-guests="' . htmlspecialchars($row['max_guests']) . '"
                     data-status="' . htmlspecialchars($row['status']) . '"
                     data-rooms="' . htmlspecialchars($row['number_of_bedrooms']) . '"
                     data-bathrooms="' . htmlspecialchars($row['number_of_bathrooms']) . '"
                     data-type="' . htmlspecialchars($row['property_type']) . '"
                     data-amenities="' . htmlspecialchars($row['amenities']) . '"
                     data-photo="../' . htmlspecialchars($first_image) .
                                            '">
                     Edit</button>  
                <button class="btn btn-danger delete-btn "name="delete"
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
                            <!-- Delete from the db  -->
                            <?php
                            // delete section area(php codes)
                            if (isset($_POST['delete'])) {
                                $id = intval($_POST['id']);
                                //retrieve the image path before deleting the record
                                $select_query = "SELECT photos FROM airbnb_properties WHERE id = ? ";
                                $stmt = mysqli_prepare($conn, $select_query);
                                mysqli_stmt_bind_param($stmt, "i", $id);
                                mysqli_stmt_execute($stmt);
                                // binding image result
                                mysqli_stmt_bind_result($stmt, $photos);
                                mysqli_stmt_fetch($stmt);
                                mysqli_stmt_close($stmt);

                                // delete image from DB
                                if (!empty($photos)) {
                                    $photo_paths = json_decode($photos, true);
                                    if (is_array($photo_paths)) {
                                        foreach ($photo_paths as $photo) {
                                            $file_path = "./" . $photo;
                                            if (file_exists($file_path)) {
                                                unlink($file_path);
                                            } else {
                                                error_log("File not found: " . $file_path);
                                            }
                                        }
                                    }
                                }


                                // delete query
                                $deleteQuery = " DELETE FROM airbnb_properties WHERE id = ?";
                                $stmt = mysqli_prepare($conn, $deleteQuery);
                                mysqli_stmt_bind_param($stmt, "i", $id);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo "<script>alert('property deleted successully');
                                    window.location.href = 'airbnb.php';
                                    </script>";
                                    exit();
                                } else {
                                    echo "<script>alert('Error deleting property:" . mysqli_error($conn) . "');</script>";
                                }
                            }

                            ?>
                            <!-- delete property model -->
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
                                            <form action="airbnb.php" method="POST" class="d-flex flex-column">
                                                <input type="hidden" name="id" id="deleteId">
                                                <button type="submit" name="delete" class="btn btn-danger" style="align-self: center;">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary ms-auto" data-bs-dismiss="modal">cancel</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Edit the form modal Area(section) -->

                            <!-- Bootstrap Modal -->
                            <div class="modal fade" id="edit_airbnbModal" tabindex="-1" aria-labelledby="airbnbModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="airbnbModalLabel">Edit Airbnb Property</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="update_propertyForm" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Property Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="description"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Price (USD)</label>
                                                    <input type="number" class="form-control" name="price" id="price" required min="0">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="number_of_bathrooms" class="form-label">Bathrooms</label>
                                                    <input type="number" class="form-control" name="bathrooms" min="0" id="bathrooms">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="max_guests" class="form-label">Max Guests</label>
                                                    <input type="number" class="form-control" name="guests" id="guests" required min="1">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label>Amenities</label>
                                                    <div id="amenities">
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
                                                <div class="mb-3">
                                                    <label for="house_rules" class="form-label">House Rules</label>
                                                    <textarea class="form-control" name="rules" id="rules"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="available">Available</option>
                                                        <option value="booked">Booked</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="property_type" class="form-label">Property Type</label>
                                                    <select type="text" class="form-control" name="type" id="type">
                                                        <option value="apartment">Apartment</option>
                                                        <option value="apartment">House</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="rooms" class="form-label">Number of Rooms</label>
                                                    <input type="number" class="form-control" name="rooms" id="rooms" required min="1">
                                                </div>


                                                <div class="mb-3">

                                                    <label class="form-label" id="photoInput">Photo</label>
                                                    <input type="file" name="photos[]" class="form-control" accept="image/*">
                                                    <small class="form-text text-muted">Current Image: <img src="" id="photos" width="100">
                                                    </small>
                                                    <input type="hidden" name="existingImg" id="existingImage">
                                                </div>
                                                <button type="submit" class="btn btn-success" name="update">Update Property</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End of Edit properties modal area -->
                            <!-- update query -->

                            <?php
                            if (isset($_POST['update'])) {
                                // Get input values
                                $id = $_POST['id'];
                                $name = htmlspecialchars(trim($_POST['name']));
                                $description = htmlspecialchars(trim($_POST['description']));
                                $status = htmlspecialchars(trim($_POST['status']));
                                $type = htmlspecialchars(trim($_POST['type']));
                                $price = floatval($_POST['price']);
                                $rules = htmlspecialchars(trim($_POST['rules']));
                                $rooms = intval($_POST['rooms']);
                                $bathrooms = intval($_POST['bathrooms']);
                                $guests = intval($_POST['guests']);
                                $address = htmlspecialchars($_POST['address']);
                                // Handle amenities
                                $amenities = isset($_POST['amenities']) ? json_encode($_POST['amenities']) : json_encode([]);
                                // Check if a new image is uploaded
                                if (!empty($_FILES['photos']['name'])) {
                                    $targetDir = 'uploads/';
                                    $fileName = basename($_FILES["photos"]["name"]);
                                    $targetFilePath = $targetDir . $fileName;

                                    // Check file type
                                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                                    if (in_array(strtolower($fileType), $allowedTypes)) {

                                        // Move the uploaded file
                                        if (move_uploaded_file($_FILES["photos"]["tmp_name"], $targetFilePath)) {
                                            $newphoto = $targetFilePath; // Save new image path
                                        } else {
                                            echo "<script>alert('Error uploading the image. Please try again later.'); 
                                            window.history.back();
                                            </script>";
                                            exit();
                                        }
                                    } else {
                                        echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
                                        window.history.back();
                                        </script>";
                                        exit();
                                    }
                                } else {
                                    // Keep the existing image
                                    if (!empty($_POST['existing_image'])) {
                                        $newphoto = mysqli_real_escape_string($conn, $_POST['existing_image']);
                                    } else {
                                        echo 'No image provided!';
                                    }
                                }
                                // Prepare the SQL statement
                                $query = "UPDATE airbnb_properties SET name = ?, description = ?, price_per_night = ?, max_guests = ?, status = ?, type = ?, amenities = ?, photo = ?, house_rules=?, address = ?, number_of_bedrooms= ?, number_of_bathrooms= ? WHERE id = ?";
                                $stmt = mysqli_prepare($conn, $query);
                                mysqli_stmt_bind_param($stmt, "ssdissssssiii", $name, $description, $price, $guests, $status, $type, $amenities, $photo, $rules, $rooms, $bathrooms, $id);
                                // Execute the query
                                if (mysqli_stmt_execute($stmt)) {
                                    echo "<script>alert('Property updated successfully!');
                                   window.location.href='airbnb.php';</script>";
                                } else {
                                    echo "<script>alert('Update failed: " . mysqli_stmt_error($stmt)."');</script>";
                                }
                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                            ?>
<script src="./js/script.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>