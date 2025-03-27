<?php
 //insert users into the system
 require('../db/conn.php');
 if ($_SERVER['REQUEST_METHOD'] === "POST") {
     $email = htmlspecialchars(trim($_POST['email']));
     $name = htmlspecialchars(trim($_POST['name']));
     $role = htmlspecialchars(trim($_POST['role']));
     $password = htmlspecialchars(trim($_POST['password']));
     $confirmpassword = htmlspecialchars(trim($_POST['confirmpassword']));
     $address = htmlspecialchars(trim($_POST['address']));
     $phone = htmlspecialchars(trim($_POST['phone']));
     $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
     $token = md5(uniqid(rand(), true));
     $insertQuery = "INSERT INTO users (email,password,role,phone,address,name,is_verified,token) VALUES (?,?,?,?,?,?,0,?)";
     // Prepare the statement
     $result = mysqli_prepare($conn, $insertQuery);
     if ($result) {
         // Bind the parameters to the prepared statement
         mysqli_stmt_bind_param($result, "sssssss", $email, $hashedpassword, $role, $phone, $address, $name, $token);
         // Execute the statement
         if (mysqli_stmt_execute($result)) {
             echo "<script>alert('Registered successfully!');
          window.location.href = './account_verify.php';</script>";
         } else {
             echo "<script>alert('Request failed!');
          window.location.href = './register.php';</script>";
         }
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
     <form action="#" method="POST" class="col-sm-4 p-5 d-flex flex-column" style="height: fit-content;">
         <h2 class="text-center fw-bold">ITUZE</h2>
         <h3 class="text-center">Register Here</h3>
         <label for="name" class="input-label">Name:</label>
         <input type="text" class="form-control" name="name">
         <label for="role">Select Role</label>
         <select name="role" id="" class="form-control">
             <option value="" disabled selected></option>
             <option value="admin">Admin</option>
             <option value="staff">Staff</option>
             <option value="customer">customer</option>
         </select>
         <label for="password">Password</label>
         <div class=" d-flex align-items-center">
             <input type="password" class="form-control" name="password" id="passwordField">
             <span class="d-flex justify-content-center"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32" id="toggleIcon">
                     <path d="M16 8C7.6644477 8 1.2558594 15.332031 1.2558594 15.332031L0.65820312 16L1.2558594 16.667969C1.2558594 16.667969 7.1907113 23.431632 15.060547 23.949219C15.369611 23.981518 15.682601 24 16 24C16.317399 24 16.630389 23.981518 16.939453 23.949219C24.809288 23.431632 30.744141 16.667969 30.744141 16.667969L31.341797 16L30.744141 15.332031C30.744141 15.332031 24.335552 8 16 8 z M 16 10C18.199689 10 20.224667 10.584909 21.988281 11.388672C22.626294 12.444129 23 13.673089 23 15C23 18.877484 19.877484 22 16 22C12.122516 22 9 18.877484 9 15C9 13.695022 9.3547131 12.481701 9.9726562 11.4375L9.9414062 11.419922C11.721156 10.599524 13.77117 10 16 10 z M 16 12 A 3 3 0 0 0 16 18 A 3 3 0 0 0 16 12 z M 24.738281 12.935547C26.635998 14.20111 27.977358 15.503785 28.462891 16C27.884631 16.590983 26.127136 18.323903 23.611328 19.777344C24.485456 18.390577 25 16.755107 25 15C25 14.287922 24.895623 13.601905 24.738281 12.935547 z M 7.2558594 12.939453C7.0995347 13.603862 7 14.290069 7 15C7 16.755107 7.5145435 18.390577 8.3886719 19.777344C5.872864 18.323903 4.1153691 16.590983 3.5371094 16C4.0221312 15.504307 5.3613657 14.203764 7.2558594 12.939453 z" />
                 </svg></span>
 
         </div>
         <label for="passwordConfirmation">Confirm password</label>
         <div class="d-flex align-items-center">
             <input type="password" class="form-control" name="confirmpassword" id="passwordField">
             <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="25" id="toggleIcon">
                     <path d="M7.5 4C2.105469 4 0.046875 8.289063 0.046875 8.289063L-0.0546875 8.5L0.046875 8.710938C0.046875 8.710938 2.105469 13 7.5 13C12.894531 13 14.953125 8.710938 14.953125 8.710938L15.050781 8.5L14.953125 8.289063C14.953125 8.289063 12.894531 4 7.5 4 Z M 7.5 5C9.4375 5 11 6.5625 11 8.5C11 10.4375 9.4375 12 7.5 12C5.5625 12 4 10.4375 4 8.5C4 6.5625 5.5625 5 7.5 5 Z M 3.941406 5.777344C3.359375 6.535156 3 7.472656 3 8.5C3 9.527344 3.359375 10.464844 3.941406 11.222656C2.023438 10.269531 1.242188 8.753906 1.117188 8.5C1.242188 8.246094 2.023438 6.730469 3.941406 5.777344 Z M 11.058594 5.777344C12.976563 6.730469 13.757813 8.246094 13.882813 8.5C13.757813 8.753906 12.976563 10.269531 11.058594 11.222656C11.640625 10.464844 12 9.527344 12 8.5C12 7.472656 11.640625 6.535156 11.058594 5.777344 Z M 7.5 7C6.671875 7 6 7.671875 6 8.5C6 9.328125 6.671875 10 7.5 10C8.328125 10 9 9.328125 9 8.5C9 7.671875 8.328125 7 7.5 7Z" />
                 </svg></span>
         </div>
         <label for="Phone">Phone:</label>
         <input type="number" class="form-control" name="phone">
         <label for="Email">Email</label>
         <input type="text" class="form-control" name="email">
         <label for="address">Address:</label>
         <textarea name="address"></textarea>
         <button class="btn bg-dark text-light" style="align-self: center;"> Register</button>
         <span>already have an account?<a href="./login.php"> Login_here </a></span>
     </form>
     <style>
         form {
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         }
     </style>
     <script src="./Js/script.js">
     </script>
 </body>
 </html>