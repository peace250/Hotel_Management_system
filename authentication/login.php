<?php
// customer's login page
require('../db/conn.php'); // Ensure database connection is included
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Sanitize input to prevent XSS & SQL Injection
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));
    error_log("Searching for user: " . $name); // Debugging log
    // Prepare SQL statement with backticks for column name
    $sql_select = "SELECT * FROM users WHERE `name` = ?";
    $stmt = mysqli_prepare($conn, $sql_select);
    if (!$stmt) {
        die("SQL Error: ".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $name);
    // Execute the statement
    if (!mysqli_stmt_execute($stmt)) {
        die("Error executing statement: " . mysqli_error($conn));
    }
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        die("Error fetching result: " . mysqli_error($conn));
    }
    if ($fetch = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $fetch['password'])) {
            // Set session variables
            $_SESSION['user'] = $fetch['name'];
            $_SESSION['id'] = $fetch['id'];
            echo "<script>alert('Successful login_');
            window.location.href('../customer/dashboard.php');
            </script>";
            

    
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
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

 <body class="d-flex justify-content-center">
     <!-- Admin_login -->
     <form action="" method="POST" class="col-sm-4 p-5 d-flex flex-column gap-2" style="height: fit-content;">
         <h2 class="text-center fw-bold">ITUZE</h2>
         <h3 class="text-center">Login</h3>
         <label for="Name" class="input-control">Name:</label>
         <input type="text" class="form-control" name="name">
         <label for="password">Password</label>
         <div class=" d-flex align-items-center">
             <input type="password" class="form-control" name="password" id="passwordField" style="border: none;
      border-bottom: 2px solid rgb(35, 35, 35); border-radius:0%">
             <span class="d-flex justify-content-center" style="width: fit-content;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32" id="toggleIcon">
                     <path d="M16 8C7.6644477 8 1.2558594 15.332031 1.2558594 15.332031L0.65820312 16L1.2558594 16.667969C1.2558594 16.667969 7.1907113 23.431632 15.060547 23.949219C15.369611 23.981518 15.682601 24 16 24C16.317399 24 16.630389 23.981518 16.939453 23.949219C24.809288 23.431632 30.744141 16.667969 30.744141 16.667969L31.341797 16L30.744141 15.332031C30.744141 15.332031 24.335552 8 16 8 z M 16 10C18.199689 10 20.224667 10.584909 21.988281 11.388672C22.626294 12.444129 23 13.673089 23 15C23 18.877484 19.877484 22 16 22C12.122516 22 9 18.877484 9 15C9 13.695022 9.3547131 12.481701 9.9726562 11.4375L9.9414062 11.419922C11.721156 10.599524 13.77117 10 16 10 z M 16 12 A 3 3 0 0 0 16 18 A 3 3 0 0 0 16 12 z M 24.738281 12.935547C26.635998 14.20111 27.977358 15.503785 28.462891 16C27.884631 16.590983 26.127136 18.323903 23.611328 19.777344C24.485456 18.390577 25 16.755107 25 15C25 14.287922 24.895623 13.601905 24.738281 12.935547 z M 7.2558594 12.939453C7.0995347 13.603862 7 14.290069 7 15C7 16.755107 7.5145435 18.390577 8.3886719 19.777344C5.872864 18.323903 4.1153691 16.590983 3.5371094 16C4.0221312 15.504307 5.3613657 14.203764 7.2558594 12.939453 z" />
                 </svg></span>

         </div>
         <button class="btn bg-dark text-light" style="align-self: center;" type="submit"> Login</button>
        
        <div class="register d-flex flex-column gap-3">
            <span><a href="./register.php">Don't have an account?</a></span>
            <button class="btn signup_btn  border-4 border-primary text-primary   fw-bold " style="border-radius: 8px;"> <a href="./register.php" class="text-decoration-none">Sign Up</a></button>
        </div>
     </form>
     <style>
         form {
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         }
         .signup_btn:hover{
            background-color: blue;
            border: transparent;
            color: #fff;
            transition: .5s ease-in-out;
         }
       

     </style>
    

     <script src="./Js/script.js"></script>
     <script src="./Js/script2.js"></script>
 </body>

 </html>