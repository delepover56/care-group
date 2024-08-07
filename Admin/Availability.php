<!DOCTYPE html>
<html lang="en">


<!-- appointments23:19-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Set Availability - Care Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
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
        // Get the doctor's ID from the session
        $doc_id = $_SESSION['id'];

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get the selected availability from the form
            $avail = $_POST['avail'];

            // Check if the availability is empty
            if (empty($avail)) {
                echo "<script>alert('Please select an availability.')</script>";
            } else {
                // Update the doctor's availability in the database
                $sql = "UPDATE user SET
            `Availability` = '$avail'
            WHERE `id` = '$doc_id'";
                $result = $conn->query($sql);

                // Check if the update was successful
                if ($result) {
                    echo "<script>alert('Availability Successfully Set')</script>";
                }
            }
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
                            <li>
                                <a href="./doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                            </li>
                            <li>
                                <a href="./patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                            </li>
                        <?php } ?>


                        <?php if ($_SESSION['Role'] == 2 || $_SESSION['Role'] == 1) {
                        ?>

                            <li>
                                <a href="./appointments.php"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                            </li>
                            <li class="active">
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
                    <div class="col-sm-12">
                        <div class="page-title">
                            <h3 class="ml-5 mb-5">Change Availability</h3>
                        </div>
                        <div class="container" style="justify-content: center;">
                            <div class="card">
                                <div class=" card-body">
                                    <div class="card-title">
                                        Dear Esteemed Medical Professionals,
                                    </div>

                                    <p class="card-text">
                                        Welcome to our advanced and user-friendly appointment scheduling platform. We understand the critical importance of efficiently managing your busy schedules while providing optimal healthcare services. To cater to your diverse needs, we are delighted to offer you the flexibility of setting appointments on a daily, weekly, or monthly basis.

                                        Our intuitive system allows you to streamline your daily routines by selecting specific time slots each day for appointments. For those preferring a broader perspective, our weekly scheduling option empowers you to plan your appointments across the entire week, ensuring a well-organized and balanced workload. Additionally, our monthly scheduling feature enables you to plan ahead, making it easier to accommodate long-term patient care.

                                        To utilize these options, simply navigate to the scheduling interface and choose the frequency that best aligns with your preferences and professional commitments. Whether you prefer the granularity of daily scheduling, the structure of weekly planning, or the foresight of monthly organization, our platform is designed to cater to your unique needs.

                                        We appreciate your dedication to providing exceptional healthcare services, and we are committed to supporting you with a scheduling system that enhances efficiency and convenience. If you have any questions or require assistance, please do not hesitate to reach out to our dedicated support team.

                                        Thank you for choosing our platform to manage your appointments effectively.
                                    </p>
                                    <div class="text-center">
                                        <form action="" method="POST" class="form-group">
                                            <select name="avail" id="avail" class="custom-select col-3">
                                                <option value="" disabled selected>Set Your Availability</option>
                                                <option value="DAILY">DAILY</option>
                                                <option value="WEEKLY">WEEKLY</option>
                                                <option value="MONTHLY">MONTHLY</option>
                                            </select>
                                            <button type="submit" name="submit" class="btn btn-info" style="margin-left: -4px;">
                                                <i class="fa-regular fa-circle-check"></i>
                                            </button>

                                        </form>
                                    </div>

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
    <script src="assets/js/app.js"></script>

</body>


<!-- appointments23:20-->

</html>