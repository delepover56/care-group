<!DOCTYPE html>
<html lang="en">


<!-- doctors23:12-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Doctors - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/d9a372d288.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#myTable').DataTable();
        });
    </script>
</head>

<body>
    <div class=" main-wrapper">

        <!-- NavBar -->
        <?php
        include_once './Components/Nav.php';
        ?>
        <?php
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
                                <a href="./appointments.php"><i class="fa fa-calendar"></i>
                                    <span>Appointments</span></a>
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
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-doctor.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Doctors currently employeed:</h6>
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped" id="myTable">
                                        <thead>
                                            <tr class="col-sm">
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Education</th>
                                                <th>Specialization</th>
                                                <th>Availablity</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <?php
                                        // Select all doctors from the database with Role 2
                                        $sql = "SELECT * FROM user WHERE `Role` = 2;";
                                        $result = $conn->query($sql);

                                        // Check if there are any doctors in the result
                                        if ($result->num_rows > 0) {
                                            // Loop through each doctor's data
                                            while ($row = $result->fetch_assoc()) {
                                                // Get individual data for each doctor
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
                                        ?>
                                                <!-- Display doctor's data in a table -->
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $user_id ?></td>
                                                        <td><?php echo $user_name ?></td>
                                                        <td><?php echo $user_email ?></td>
                                                        <td><?php echo $user_phone ?></td>
                                                        <td><?php echo $user_city ?></td>
                                                        <td><?php echo $user_edu ?></td>
                                                        <td><?php echo $user_spec ?></td>
                                                        <td><?php echo $user_avail ?></td>
                                                        <td class="text-center">
                                                            <!-- Links to edit and delete pages for each doctor -->
                                                            <a href="./edit-doctor.php?id=<?php echo $user_id; ?>">
                                                                <span class="btn bg-white" style="cursor:pointer; border-radius: 20px;">
                                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                                </span>
                                                            </a>
                                                            <a href="./delete-doctor.php?action=delete&id=<?php echo $user_id; ?>">
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
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- doctors23:17-->

</html>