<!DOCTYPE html>
<html lang="en">


<!-- edit-doctor24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Edit Doctor - Care Groups</title>
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
        include_once './Components/nav.php';
        if ($_SESSION['Role'] == 2) {
            header("location:./index.php");
        }
        ?>
        <!-- NavBar -->

        <!-- Php -->
        <?php
        // Check if the doctor ID is set in the URL
        if (isset($_GET['id'])) {
            // Get the doctor ID from the URL
            $doctor_id = $_GET['id'];

            // Fetch doctor details from the database based on the ID and Role = 2 (Doctor)
            $sql = "SELECT * FROM user WHERE `id` = $doctor_id AND `Role` = 2";
            $result = $conn->query($sql);

            // Check if the doctor with the specified ID exists and is a doctor
            if ($result->num_rows > 0) {
                // Fetch doctor details
                $row = $result->fetch_assoc();
                $doctor_name = $row['name'];
                $doctor_email = $row['email'];
                $doctor_phone = $row['phone'];
                $doctor_password = $row['password'];
                $doctor_city = $row['City'];
                $doctor_edu = $row['Education'];
                $doctor_spec = $row['Specialization'];
                $doctor_avail = $row['Availability'];

                // Check if the form is submitted
                if (isset($_POST['submit'])) {
                    // Get form data
                    $dname = $_POST['name'];
                    $demail = $_POST['email'];
                    $dpassword = $_POST['password'];
                    $dphone = $_POST['phone'];
                    $dcity = $_POST['city'];
                    $dedu = $_POST['edu'];
                    $dspec = $_POST['spec'];
                    $davail = $_POST['avail'];

                    // Validation: Check if any field is empty
                    if (empty($dname) || empty($demail) || empty($dpassword) || empty($dphone) || empty($dcity) || empty($dedu) || empty($dspec) || empty($davail)) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                <strong>Error!</strong> All fields are required.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                    } else {
                        // Validation: Check if the phone number matches the pattern
                        if (!preg_match('/^\d{11}$/', $dphone)) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 51px; margin-left: 221px;">
                    <strong>Error!</strong> Please enter a valid 11-digit phone number.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                        } else {
                            // Update doctor information in the database
                            $updateSql = "UPDATE user SET 
                        `name` = '$dname', 
                        `email` = '$demail', 
                        `password` = '$dpassword', 
                        `phone` = '$dphone', 
                        `City` = '$dcity', 
                        `Education` = '$dedu', 
                        `Specialization` = '$dspec',
                        `Availability` = '$davail'
                    WHERE `id` = '$doctor_id'";

                            $updateResult = $conn->query($updateSql);

                            // Check if the update was successful
                            if ($updateResult) {
                                header('location:./doctors.php');
                            } else {
                                // Display an error message if the update fails
                                echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                        <strong>Error!</strong> Failed to update doctor information.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                            }
                        }
                    }
                }
            } else {
                // Handle if doctor not found
                echo 'Doctor not found.';
                exit;
            }
        } else {
            // Handle if ID is not provided
            echo 'Doctor ID not provided.';
            exit;
        }
        ?>


        <!-- Php -->

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
                        <?php if ($_SESSION['Role'] == 1) {
                        ?>
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
                        <h4 class="page-title">Edit a Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 offset-lg-2">
                        <form method="POST" action="" autocomplete="on">
                            <input type="hidden" name="id" value="<?php echo $doctor_id; ?>">
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- <div class="form-group">
                                        <label for="id">ID<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="id" id="id" style="border-radius: 20px;" value="" required>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="dname">name</label>
                                        <input class="form-control" type="text" name="name" id="dname" style="border-radius: 20px;" value="<?php echo $doctor_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input class="form-control border-right-0" type="password" name="password" id="password" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px; margin-right: -4px;" value="<?php echo $doctor_password; ?>">
                                            <span id="show-password" class="input-group-text border-left-0 bg-white" style="cursor:pointer; border-top-right-radius: 20px; border-bottom-right-radius: 20px; margin-left: -4px;">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-6">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dmail">Email</label>
                                            <input class="form-control" type="email" name="email" id="dmail" style="border-radius: 20px;" value="<?php echo $doctor_email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="davail">Availablity</label>
                                            <input type="text" class="form-control" name="avail" id="davail" style="border-radius: 20px;" value="<?php echo $doctor_avail; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class=" col-sm-6">

                                    </div>
                                </div> -->
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="dphone">Phone</label>
                                                <input class="form-control" type="text" name="phone" id="dphone" style="border-radius: 20px;" value="<?php echo $doctor_phone; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="dcity">City</label>
                                                <input type="text" class="form-control" name="city" id="dcity" style="border-radius: 20px;" value="<?php echo $doctor_city; ?>">
                                            </div>
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3">
                                                
                                            </div> -->
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">

                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="dedu">Education</label>
                                                <input type="text" class="form-control" name="edu" id="dedu" style="border-radius: 20px;" value="<?php echo $doctor_edu; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="dspec">Specialization</label>
                                                <input type="text" class="form-control" name="spec" id="dspec" style="border-radius: 20px;" value="<?php echo $doctor_spec; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="m-t-20 text-center ml-3 mb-3">
                                                    <button class="btn btn-primary submit-btn" style="cursor: pointer;" type="submit" name="submit">Save
                                                        changes</button>
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
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- edit-doctor24:06-->

</html>