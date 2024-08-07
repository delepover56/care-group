<?php
// Include configuration file
require_once "./Components/config.php";

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    // Validation: Check if any field is empty
    if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> All fields are required.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    } else {
        // Validation: Check if the phone number matches the pattern
        if (!preg_match('/^\d{11}$/', $phone)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please enter a valid 11-digit phone number.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        } else {
            // Check if the email already exists in the database
            $sql = "SELECT * FROM user WHERE email='$email';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $useremail = $row['email'];
                }
                // Display a warning if the email already exists
                if ($useremail === $email) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Email already exists.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                }
            } else {
                // Insert data into the database
                $insertSql = "INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `Role`, `City`, `Education`, `Specialization`) 
                VALUES (NULL, '$name', '$email', '$password', '$phone', '3', NULL, NULL, NULL);";

                $insertResult = $conn->query($insertSql);

                // Redirect to login page if the data is inserted successfully
                if ($insertResult) {
                    header("Location: login.php");
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo-dark.png">
    <title>Register - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/d9a372d288.js" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="" method="post" autocomplete="on">
                        <div class="account-logo">
                            <a href="register.php"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" name="name" id="name" style="border-radius: 20px;">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" style="border-radius: 20px;">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-right-0" name="password" id="password" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                <span id="show-password" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                    <i class="fa-regular fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" style="border-radius: 20px;">

                        </div>
                        <div class="form-group checkbox">
                            <label for="check">
                                <input type="checkbox" name="check" id="check" required> I have read and agree the Terms
                                & Conditions
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" name="submit" type="submit">Signup</button>
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add an event listener to the element with ID 'show-password'
        document.getElementById('show-password').addEventListener('click', function() {
            // Get the password input element
            var passwordInput = document.getElementById('password');

            // Check the type of the password input
            if (passwordInput.type === 'password') {
                // If it's a password field, change it to a text field
                passwordInput.type = 'text';
                // Change the innerHTML to show the eye-slash icon
                this.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                // If it's a text field, change it back to a password field
                passwordInput.type = 'password';
                // Change the innerHTML to show the eye icon
                this.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        });
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- register24:03-->

</html>