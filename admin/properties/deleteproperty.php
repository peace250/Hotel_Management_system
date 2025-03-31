<?php
// Get Id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die("Invalid property ID.");
}

// delete query
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete'])) {
    $sql_delete = "DELETE FROM hotel_rooms WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $run_delete_query = mysqli_stmt_execute($stmt);
    if ($run_delete_query) {
        echo "<script>alert('deleted successfully!')
        </script>";
    } else {
        die("error occured") . mysqli_error($conn);
    }
}
