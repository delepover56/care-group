<!DOCTYPE html>
<html lang="en">


<!-- change-password24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Change Password - Care Groups</title>
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
    <div class="main-wrapper">
        <!-- NavBar -->
        <?php
        include_once './Components/nav.php';
        ?>
        <!-- NavBar -->

        <!-- Php -->
        <?php
        // Get the current user's ID from the session
        $userCurrentId = $_SESSION['id'];

        // Query to fetch the user's password from the database
        $fetchPassSql = "SELECT * FROM `user` WHERE `id` = '$userCurrentId'";
        $resultFetchPass = $conn->query($fetchPassSql);

        // Check if the query returned any results
        if ($resultFetchPass->num_rows > 0) {
            // Fetch the user's password from the result
            $rowFetchPass = $resultFetchPass->fetch_assoc();
            $checkPass = $rowFetchPass['password'];
        }

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get old and new passwords from the form
            $oldPass = $_POST['passOld'];
            $newPass = $_POST['passNew'];
            $newPassCheck = $_POST['passNewCheck'];

            // Basic form validations: Check if any required fields are empty
            if (empty($oldPass) || empty($newPass) || empty($newPassCheck)) {
                echo '<script>alert("Please fill in all required fields.");</script>';
            } else {
                // Check if the old password matches the stored password
                if ($checkPass == $oldPass) {
                    // Check if the new passwords match
                    if ($newPass == $newPassCheck) {
                        // Update the password in the database
                        $updatePassSql = "UPDATE `user` SET `password` = '$newPass' WHERE `id` = '$userCurrentId'";
                        $resultUpdatePass = $conn->query($updatePassSql);

                        // Check if the password update was successful
                        if ($resultUpdatePass) {
                            echo '<script>alert("Password Updated Successfully");</script>';
                        }
                    } else {
                        // Alert if the new passwords do not match
                        echo '<script>alert("Passwords do not match");</script>';
                    }
                } else {
                    // Alert if the old password is incorrect
                    echo '<script>alert("Incorrect Password");</script>';
                }
            }
        }
        ?>



        <!-- Php -->

        <!-- SideBar -->
        <?php
        include_once './Components/Sidebar.php';
        ?>
        <!-- SideBar -->
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h4 class="page-title">Change Password</h4>
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Current password</label>
                                        <div class="input-group">
                                            <input type="password" name="passOld" id="passOld" class="form-control" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                            <span id="show-password-old" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <div class="input-group">
                                            <input type="password" name="passNew" id="passNew" class="form-control" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                            <span id="show-password-new" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <div class="input-group">
                                            <input type="password" name="passNewCheck" id="passNewCheck" class="form-control" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                            <span id="show-password-new-check" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center m-t-20">
                                    <button type="submit" name="submit" class="btn btn-info submit-btn">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        // Event listener for toggling visibility of old password input
        document.getElementById('show-password-old').addEventListener('click', function() {
            var passwordInput = document.getElementById('passOld');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        });

        // Event listener for toggling visibility of new password input
        document.getElementById('show-password-new').addEventListener('click', function() {
            var passwordInput = document.getElementById('passNew');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        });

        // Event listener for toggling visibility of new password confirmation input
        document.getElementById('show-password-new-check').addEventListener('click', function() {
            var passwordInput = document.getElementById('passNewCheck');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        });
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- change-password24:06-->

</html>