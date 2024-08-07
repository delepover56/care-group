<?php
// Include configuration file
include_once './components/config.php';

// Start or resume the session
session_start();

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    // Get user input from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation: Check if email and password are not empty
    if (empty($email) || empty($password)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Both email and password are required fields.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    } else {
        // Query the database to check if the email exists
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);

        // Check if the email exists in the database
        if ($result->num_rows > 0) {
            // Fetch user details
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['id'];
                $user_name = $row['name'];
                $user_email = $row['email'];
                $user_password = $row['password'];
                $user_phone = $row['phone'];
                $user_role = $row['Role'];
                $user_city = $row['City'];
                $user_edu = $row['Education'];
                $user_spec = $row['Specialization'];
                $user_avail = $row['Availability'];
            }

            // Check if the entered password matches the stored password
            if ($password == $user_password) {
                // Set session variables for the user
                $_SESSION['id'] = $user_id;
                $_SESSION['Username'] = $user_name;
                $_SESSION['Email'] = $user_email;
                $_SESSION['Pass'] = $user_password;
                $_SESSION['Phone'] = $user_phone;
                $_SESSION['Role'] = $user_role;
                $_SESSION['City'] = $user_city;
                $_SESSION['edu'] = $user_edu;
                $_SESSION['spec'] = $user_spec;
                $_SESSION['avail'] = $user_avail;

                // Redirect based on user role
                if ($user_role == 3) {
                    header('location: ../index.php');
                } elseif ($user_role == 1 || $user_role == 2) {
                    header('location: ./index.php');
                }
            } else {
                // Display an error message if the password is incorrect
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Password is incorrect.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            // Display a warning if the email does not exist
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error :</strong>
                Email does not exist! <a href="./register.php">Click here</a> to create an account.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<!-- login23:11-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Login - Care Groups</title>
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
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="" class="form-signin needs-validation" method="post" autocomplete="on">
                        <div class="account-logo">
                            <a href="./login.php"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" autofocus="" class="form-control" name="email" id="email" style="border-radius: 20px;">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <!-- <div class="form-group text-right">
                            <a href="change-password2.php">Forgot your password?</a>
                        </div> -->
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.php">Register Now</a>
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


<!-- login23:12-->

</html>