<!DOCTYPE html>
<html lang="en">


<!-- appointments23:19-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Appointments - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                            <li>
                                <a href="./patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['Role'] == 2 || $_SESSION['Role'] == 1) {
                        ?>

                            <li class="active">
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Disease</th>
                                        <th>Doctor</th>
                                    </tr>
                                </thead>
                                <?php
                                // Check if the user has the role of a doctor (Role == 2)
                                if ($_SESSION['Role'] == 2) {
                                    // Retrieve appointments where the doctor's name matches the logged-in doctor's username
                                    $AdminSql = "SELECT * FROM `appointments` WHERE `Doctor_Name` = '$_SESSION[Username]'";
                                    $AdminResult = $conn->query($AdminSql);

                                    // Check if there are appointments for the doctor
                                    if ($AdminResult->num_rows > 0) {
                                        // Loop through each appointment and display relevant information
                                        while ($rows = $AdminResult->fetch_assoc()) {
                                            $id = $rows['A_ID'];
                                            $patient = $rows['Patient_name'];
                                            $email = $rows['Patient_email'];
                                            $phone = $rows['Patient_phone'];
                                            $disease = $rows['Disease'];
                                            $doctor = $rows['Doctor_Name'];
                                ?>
                                            <!-- Display appointment information in a table row -->
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $patient; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $disease; ?></td>
                                                    <td><?php echo $doctor; ?></td>
                                                </tr>
                                            </tbody>
                                        <?php
                                        }
                                    }
                                }

                                // Check if the user has the role of an admin (Role == 1)
                                if ($_SESSION['Role'] == 1) {
                                    // Retrieve all appointments for admins
                                    $AdminSql = "SELECT * FROM `appointments`";
                                    $AdminResult = $conn->query($AdminSql);

                                    // Check if there are appointments
                                    if ($AdminResult->num_rows > 0) {
                                        // Loop through each appointment and display relevant information
                                        while ($rows = $AdminResult->fetch_assoc()) {
                                            $id = $rows['A_ID'];
                                            $patient = $rows['Patient_name'];
                                            $email = $rows['Patient_email'];
                                            $phone = $rows['Patient_phone'];
                                            $disease = $rows['Disease'];
                                            $doctor = $rows['Doctor_Name'];
                                        ?>
                                            <!-- Display appointment information in a table row -->
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $id; ?></td>
                                                    <td><?php echo $patient; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $disease; ?></td>
                                                    <td><?php echo $doctor; ?></td>
                                                </tr>
                                            </tbody>
                                <?php
                                        }
                                    }
                                }
                                ?>


                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script>
</body>


<!-- appointments23:20-->

</html>