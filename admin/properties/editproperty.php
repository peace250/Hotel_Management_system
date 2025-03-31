
<!-- update data -->
<?php
   // Get Id
   if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die("Invalid property ID.");
}
// Fetch property data for editing
$select_property = "SELECT * FROM hotel_rooms WHERE id = ?";
$stmt = mysqli_prepare($conn, $select_property);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$fetch = mysqli_fetch_assoc($result);

if (!$fetch) {
    die("Property not found.");
}
           
    // Handle the form submission for editing the property
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['edit'])) {
        // Collect form data
        $name = htmlspecialchars(trim($_POST['name']));
        $description = htmlspecialchars(trim($_POST['description']));
        $capacity = intval($_POST['capacity']);
        $amenitiesArray = isset($_POST['amenities']) && is_array($_POST['amenities']) ? $_POST['amenities'] : [];
        $sanitizedAmenities = array_map('htmlspecialchars', $amenitiesArray);
        $amenitiesJson = json_encode($sanitizedAmenities);
        $status = htmlspecialchars(trim($_POST['status']));
        $type = htmlspecialchars(trim($_POST['type']));
        $price = floatval($_POST['price']);

        // Handle the image upload if a new image is provided
        $imagePath = $fetch['image']; // Default to the current image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = basename($_FILES['image']['name']);
            $uploadDir = '../uploads'; // Directory to store uploaded images
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $imagePath = $uploadDir . '/' . $imageName; // New image path
            if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                die("Error uploading the image. Check folder permissions.");
            }
            $imagePath = '../uploads/' . $imageName; // Database path
        }

        // Update the property in the database
        $update_property = "UPDATE hotel_rooms 
                        SET name = ?, description = ?, type = ?, price = ?, image = ?, capacity = ?, amenities = ?, status = ? 
                        WHERE id = ?";
                        
        $stmt = mysqli_prepare($conn, $update_property);
        mysqli_stmt_bind_param($stmt, "sssdssssi", $name, $description, $type, $price, $imagePath, $capacity, $amenitiesJson, $status, $id);
       
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Property Updated successfully!'); window.location.href = 'property.php';</script>";
            } else {
                echo "Database Error: " . mysqli_error($conn);
            }
        } 
    ?>


