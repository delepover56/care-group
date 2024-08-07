<!DOCTYPE html>
<html lang="en">


<!-- departments23:21-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Cities & Departments - Care Groups</title>
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
                        <h4 class="page-title">Cities</h4>
                    </div>
                    <div class="col-sm-7 col-7 text-right m-b-30">
                        <a href="add-city.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add
                            City</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>C-ID</th>
                                        <th>City Name</th>
                                        <th>Departments</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <!-- city php -->
                                <?php
                                // Select all cities from the database
                                $citySql = "SELECT * FROM cities";
                                $cityResult = $conn->query($citySql);

                                // Check if there are any cities in the result
                                if ($cityResult->num_rows > 0) {
                                    // Loop through each city's data
                                    while ($rowCity = $cityResult->fetch_assoc()) {
                                        // Get individual data for each city
                                        $c_id = $rowCity['C_ID'];
                                        $c_name = $rowCity['C_Name'];
                                        $c_dep = $rowCity['Departments'];
                                ?>
                                        <!-- Display city's data in a table -->
                                        <tbody>
                                            <tr>
                                                <td><?php echo $c_id; ?></td>
                                                <td><?php echo $c_name; ?></td>
                                                <td><?php echo $c_dep; ?></td>
                                                <td class="text-center">
                                                    <!-- Links to edit and delete pages for each city -->
                                                    <a href="./edit-city.php?id=<?php echo $c_id; ?>">
                                                        <span class="btn bg-white" style="cursor:pointer; border-radius: 20px;">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </span>
                                                    </a>
                                                    <a href="./delete-city.php?action=delete&id=<?php echo $c_id; ?>">
                                                        <span class="btn bg-white" style="cursor:pointer; border-radius: 20px;">
                                                            <i class="fa-regular fa-circle-xmark"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                }
                                ?>

                            </table>
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