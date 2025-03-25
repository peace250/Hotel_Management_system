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
    $insertQuery = "INSERT INTO users (id,email,password,role,phone,address,name,is_verified,token) VALUES ('','$email','$hashedpassword','$role','$phone','$address','$name',0,'$token')";
    $runInsert = mysqli_query($conn, $insertQuery);
if($runInsert){
    echo "
    <script>
    alert('Registered successfully!')
    window.location.href = './login.php'
    </script>
    ";
}else{
    echo "
    <script>
    alert('Request failed!')
    window.location.href = './register.php'
    </script>
    ";
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
        <h1>Sign_up_Here</h1>
        <label for="name" class="input-label">Name:</label>
        <input type="text" class="form-control" name="name">
        <label for="role">Select Role</label>
        <select name="role" id="" class="form-control">
            <option value="disabled selected"></option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="customer">customer</option>
        </select>
        <label for="password">Password</label>
        <div class="d-flex">
            <input type="password" class="form-control" name="password">
            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="30" height="30">
                    <path d="M7.5 4C2.105469 4 0.046875 8.289063 0.046875 8.289063L-0.0546875 8.5L0.046875 8.710938C0.046875 8.710938 2.105469 13 7.5 13C12.894531 13 14.953125 8.710938 14.953125 8.710938L15.050781 8.5L14.953125 8.289063C14.953125 8.289063 12.894531 4 7.5 4 Z M 7.5 5C9.4375 5 11 6.5625 11 8.5C11 10.4375 9.4375 12 7.5 12C5.5625 12 4 10.4375 4 8.5C4 6.5625 5.5625 5 7.5 5 Z M 3.941406 5.777344C3.359375 6.535156 3 7.472656 3 8.5C3 9.527344 3.359375 10.464844 3.941406 11.222656C2.023438 10.269531 1.242188 8.753906 1.117188 8.5C1.242188 8.246094 2.023438 6.730469 3.941406 5.777344 Z M 11.058594 5.777344C12.976563 6.730469 13.757813 8.246094 13.882813 8.5C13.757813 8.753906 12.976563 10.269531 11.058594 11.222656C11.640625 10.464844 12 9.527344 12 8.5C12 7.472656 11.640625 6.535156 11.058594 5.777344 Z M 7.5 7C6.671875 7 6 7.671875 6 8.5C6 9.328125 6.671875 10 7.5 10C8.328125 10 9 9.328125 9 8.5C9 7.671875 8.328125 7 7.5 7Z" />
                </svg></span>
            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="30" height="30">
                    <path d="M3.71875 2.28125L2.28125 3.71875L8.46875 9.875L21.4375 22.84375L28.28125 29.71875L29.71875 28.28125L23.375 21.9375C27.472656 19.851563 30.527344 16.910156 30.71875 16.71875L31.375 16.0625L30.75 15.34375C30.492188 15.042969 24.394531 8 16 8C14.007813 8 12.152344 8.417969 10.46875 9.03125 Z M 16 10C18.164063 10 20.160156 10.554688 21.9375 11.34375C22.613281 12.445313 23 13.699219 23 15C23 16.816406 22.300781 18.46875 21.15625 19.71875L18.3125 16.875C18.726563 16.363281 19 15.710938 19 15C19 13.347656 17.652344 12 16 12C15.289063 12 14.636719 12.273438 14.125 12.6875L12.0625 10.625C13.300781 10.253906 14.609375 10 16 10 Z M 6.625 10.875C3.386719 12.863281 1.394531 15.171875 1.25 15.34375L0.625 16.0625L1.28125 16.71875C1.566406 17.003906 8.097656 23.382813 15.0625 23.9375L15.125 23.9375C15.414063 23.960938 15.710938 24 16 24C16.289063 24 16.585938 23.960938 16.875 23.9375L16.9375 23.9375C17.734375 23.875 18.535156 23.730469 19.3125 23.53125L17.59375 21.8125C17.34375 21.871094 17.074219 21.910156 16.8125 21.9375L16.6875 21.96875C16.21875 22.007813 15.777344 22.007813 15.3125 21.96875L15.21875 21.9375C11.679688 21.539063 9 18.566406 9 15C9 14.464844 9.066406 13.949219 9.1875 13.4375 Z M 7.28125 12.84375C7.105469 13.546875 7 14.261719 7 15C7 16.613281 7.4375 18.121094 8.1875 19.4375C6.066406 18.175781 4.320313 16.75 3.40625 15.9375C4.152344 15.195313 5.507813 13.988281 7.28125 12.84375 Z M 24.71875 12.84375C26.492188 13.988281 27.816406 15.226563 28.5625 15.96875C27.648438 16.78125 25.933594 18.175781 23.8125 19.4375C24.5625 18.121094 25 16.613281 25 15C25 14.265625 24.890625 13.546875 24.71875 12.84375 Z M 16 14C16.550781 14 17 14.449219 17 15C17 15.164063 16.945313 15.300781 16.875 15.4375L15.5625 14.125C15.699219 14.054688 15.835938 14 16 14Z" />
                </svg></span>
        </div>
        <label for="passwordConfirmation">Confirm password</label>
        <div class="d-flex">
            <input type="password" class="form-control" name="confirmpassword">
            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="30" height="30">
                    <path d="M7.5 4C2.105469 4 0.046875 8.289063 0.046875 8.289063L-0.0546875 8.5L0.046875 8.710938C0.046875 8.710938 2.105469 13 7.5 13C12.894531 13 14.953125 8.710938 14.953125 8.710938L15.050781 8.5L14.953125 8.289063C14.953125 8.289063 12.894531 4 7.5 4 Z M 7.5 5C9.4375 5 11 6.5625 11 8.5C11 10.4375 9.4375 12 7.5 12C5.5625 12 4 10.4375 4 8.5C4 6.5625 5.5625 5 7.5 5 Z M 3.941406 5.777344C3.359375 6.535156 3 7.472656 3 8.5C3 9.527344 3.359375 10.464844 3.941406 11.222656C2.023438 10.269531 1.242188 8.753906 1.117188 8.5C1.242188 8.246094 2.023438 6.730469 3.941406 5.777344 Z M 11.058594 5.777344C12.976563 6.730469 13.757813 8.246094 13.882813 8.5C13.757813 8.753906 12.976563 10.269531 11.058594 11.222656C11.640625 10.464844 12 9.527344 12 8.5C12 7.472656 11.640625 6.535156 11.058594 5.777344 Z M 7.5 7C6.671875 7 6 7.671875 6 8.5C6 9.328125 6.671875 10 7.5 10C8.328125 10 9 9.328125 9 8.5C9 7.671875 8.328125 7 7.5 7Z" />
                </svg></span>
            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="30" height="30">
                    <path d="M3.71875 2.28125L2.28125 3.71875L8.46875 9.875L21.4375 22.84375L28.28125 29.71875L29.71875 28.28125L23.375 21.9375C27.472656 19.851563 30.527344 16.910156 30.71875 16.71875L31.375 16.0625L30.75 15.34375C30.492188 15.042969 24.394531 8 16 8C14.007813 8 12.152344 8.417969 10.46875 9.03125 Z M 16 10C18.164063 10 20.160156 10.554688 21.9375 11.34375C22.613281 12.445313 23 13.699219 23 15C23 16.816406 22.300781 18.46875 21.15625 19.71875L18.3125 16.875C18.726563 16.363281 19 15.710938 19 15C19 13.347656 17.652344 12 16 12C15.289063 12 14.636719 12.273438 14.125 12.6875L12.0625 10.625C13.300781 10.253906 14.609375 10 16 10 Z M 6.625 10.875C3.386719 12.863281 1.394531 15.171875 1.25 15.34375L0.625 16.0625L1.28125 16.71875C1.566406 17.003906 8.097656 23.382813 15.0625 23.9375L15.125 23.9375C15.414063 23.960938 15.710938 24 16 24C16.289063 24 16.585938 23.960938 16.875 23.9375L16.9375 23.9375C17.734375 23.875 18.535156 23.730469 19.3125 23.53125L17.59375 21.8125C17.34375 21.871094 17.074219 21.910156 16.8125 21.9375L16.6875 21.96875C16.21875 22.007813 15.777344 22.007813 15.3125 21.96875L15.21875 21.9375C11.679688 21.539063 9 18.566406 9 15C9 14.464844 9.066406 13.949219 9.1875 13.4375 Z M 7.28125 12.84375C7.105469 13.546875 7 14.261719 7 15C7 16.613281 7.4375 18.121094 8.1875 19.4375C6.066406 18.175781 4.320313 16.75 3.40625 15.9375C4.152344 15.195313 5.507813 13.988281 7.28125 12.84375 Z M 24.71875 12.84375C26.492188 13.988281 27.816406 15.226563 28.5625 15.96875C27.648438 16.78125 25.933594 18.175781 23.8125 19.4375C24.5625 18.121094 25 16.613281 25 15C25 14.265625 24.890625 13.546875 24.71875 12.84375 Z M 16 14C16.550781 14 17 14.449219 17 15C17 15.164063 16.945313 15.300781 16.875 15.4375L15.5625 14.125C15.699219 14.054688 15.835938 14 16 14Z" />
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
    <script>
        document.querySelector("form").addEventListener("submit", function(submit_input) {
            let password = document.querySelector("input[name='password']").value;
            let confirmPassword = document.querySelector("input[name='confirmpassword']").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                // Prevent form submission instantly
                submit_input.preventDefault();
            }
        });
    </script>
    <style>
        form {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>

</html>