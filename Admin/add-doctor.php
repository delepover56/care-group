<!DOCTYPE html>
<html lang="en">

<!-- add-doctor24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Add Doctors - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
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
        include_once './Components/Nav.php';
        if ($_SESSION['Role'] == 2) {
            header("location:./index.php");
        }
        ?>
        <!-- NavBar -->

        <?php
        // Check if the submit button is clicked
        if (isset($_POST['submit'])) {

            // Retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $password_check = $_POST['password_check'];
            $city = $_POST['city'];
            $edu = $_POST['edu'];
            $spec = $_POST['spec'];
            $avail = $_POST['avail'];

            // Basic form validations: Check if any required fields are empty
            if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($password_check) || empty($city) || empty($edu) || empty($spec) || empty($avail)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
        <strong>Error!</strong> Please fill in all required fields.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
            } else {

                // Validation: Check if the phone number matches the pattern
                if (!preg_match('/^\d{11}$/', $phone)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 51px; margin-left: 221px;">
            <strong>Error!</strong> Please enter a valid 11-digit phone number.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                } else {
                    // Check if the email already exists in the database
                    $sql = "SELECT * FROM user WHERE email = '$email' ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $useremail = $row['email'];
                        }
                        if ($useremail === $email) {
                            echo '<div class="alert alert-warning alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                    <strong>Error!</strong> Email already exists.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                        }
                    } elseif ($password == $password_check) {
                        // Insert user data into the database
                        $sql = "INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `Role`, `City`, `Education`, `Specialization`, `Availability`) 
                VALUES (NULL, '$name', '$email', '$password', '$phone', '2', '$city', '$edu', '$spec', '$avail');";

                        $result = $conn->query($sql);

                        if ($result) {
                            // Redirect to the doctors.php page after successful registration
                            header('location: ./doctors.php');
                        }
                    } else {
                        // Display an error if passwords do not match
                        echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                <strong>Error!</strong> Passwords do not match.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                    }
                }
            }
        }
        ?>



        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <?php
                        if ($_SESSION['Role'] == 1 || 2) {
                        ?>
                            <li>
                                <a href="./index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                            </li>
                        <?php } ?>
                        <?php
                        if ($_SESSION['Role'] == 1) {
                        ?>
                            <li class="active">
                                <a href="./doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['Role'] == 2 || $_SESSION['Role'] == 1) {
                        ?>
                            <li>
                                <a href="./patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                            </li>
                            <li>
                                <a href="./appointments.php"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                            </li>
                            <li>
                                <a href="./Availability.php"><i class="fa fa-check"></i> <span>Change Availability</span></a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['Role'] == 1) { ?>
                            <li>
                                <a href="./departments.php"><i class="fa fa-hospital-o"></i> <span>Cities &
                                        Departments</span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 offset-lg-2">
                        <form method="POST" action="" autocomplete="on">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="dname">Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" id="dname" style="border-radius: 20px;" style="border-radius: 20px;">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dmail">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" id="dmail" style="border-radius: 20px;">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="dphone">Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="phone" id="dphone" style="border-radius: 20px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input class="form-control border-right-0" type="password" name="password" id="password" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                                    <span id="show-password" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="password_check">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input class="form-control border-right-0" type="password" name="password_check" id="password-check" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;">
                                                    <span id="show-password-check" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="dcity">City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="city" id="dcity" style="border-radius: 20px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="dedu">Education <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="edu" id="dedu" style="border-radius: 20px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="dspec">Specialization <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="spec" id="dspec" style="border-radius: 20px;">
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="davil">Availability <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="avail" id="davail" style="border-radius: 20px;">
                                            </div>
                                        </div> -->
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="m-t-20 text-center ml-3 mb-3">
                                                    <button class="btn btn-primary submit-btn" style="cursor: pointer;" type="submit" name="submit">Create
                                                        Doctor</button>
                                                </div>
                                            </div>
                                        </div>
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
        document.getElementById('show-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fa-regular fa-eye"></i>';
            }
        });
        document.getElementById('show-password-check').addEventListener('click', function() {
            var passwordInput = document.getElementById('password-check');
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-doctor24:06-->

</html>