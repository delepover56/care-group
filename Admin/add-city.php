<!DOCTYPE html>
<html lang="en">


<!-- departments23:21-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Add Cities - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
        include_once './Components/Nav.php';
        if ($_SESSION['Role'] == 2) {
            header("location:./index.php");
        }
        ?>
        <!-- NavBar -->

        <!-- php -->

        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get values from the form
            $c_name = $_POST['c-name'];
            $dep = $_POST['dep'];

            // Basic form validations: Check if any required fields are empty
            if (empty($c_name) || empty($dep)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
            <strong>Error!</strong> Please fill in all required fields.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            } else {
                // Check if the city already exists
                $checkCity = "SELECT * FROM cities WHERE C_Name = '$c_name'";
                $checkResult = $conn->query($checkCity);

                if ($checkResult->num_rows > 0) {
                    // Alert if the city already exists
                    echo '<div class="alert alert-warning alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                <strong>Error!</strong> City already exists.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                } else {
                    // Insert the new city into the database
                    $insertSql = "INSERT INTO `cities` (`C_ID`, `C_Name`, `Departments`) 
                VALUES (NULL, '$c_name', '$dep');";
                    $insertResult = $conn->query($insertSql);

                    // Display success message
                    echo '<div class="alert alert-success alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
                <strong>Success!</strong> City added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
                }
            }
        }
        ?>


        <!-- php -->

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
                            <li>
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
                            <li class="active">
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
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">Add Cities</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" class="form-group">
                            <div class="form-group">
                                <label for="c-name">City Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="c-name" id="c-name">
                            </div>
                            <div class="form-group">
                                <label for="dep">Departments<span class="text-danger">*</span></label>
                                <textarea cols="30" rows="4" class="form-control" name="dep" id="dep"></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-info submit-btn" name="submit">Add Cities</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/app.js"></script>
</body>


<!-- departments23:21-->

</html>