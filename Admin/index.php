<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Dashboard - Care Groups</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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

        <!-- Php -->
        <?php

        // counting doctors

        $docSql = "SELECT COUNT(*) AS totalDocs FROM `user` WHERE `Role` = 2";
        $resultDoc = $conn->query($docSql);
        if ($resultDoc) {
            $doctors = $resultDoc->fetch_assoc();
            $totalDocs = $doctors['totalDocs'];
        }

        // counting patients

        $patSql = "SELECT COUNT(*) AS totalPat FROM `user` WHERE `Role` = 3";
        $resultPat = $conn->query($patSql);
        if ($resultPat) {
            $patients = $resultPat->fetch_assoc();
            $totalPats = $patients['totalPat'];
        }

        // counting locations

        $locSql = "SELECT COUNT(*) AS totalLoc FROM `cities`";
        $resultLoc = $conn->query($locSql);
        if ($resultPat) {
            $Locations = $resultLoc->fetch_assoc();
            $totalLocs = $Locations['totalLoc'];
        }

        // counting appointments

        $appSql = "SELECT COUNT(*) AS totalApp FROM `cities`";
        $resultApp = $conn->query($appSql);
        if ($resultApp) {
            $Appoints = $resultApp->fetch_assoc();
            $totalApps = $Appoints['totalApp'];
        }

        // counting patients for doctor

        $docPatSql = "SELECT COUNT(*) AS totalDocPat FROM `appointments` WHERE `Doctor_Name` = '$_SESSION[Username]'";
        $resultDocPat = $conn->query($docPatSql);
        if ($resultDocPat) {
            $docPatients = $resultDocPat->fetch_assoc();
            $totalDocPats = $docPatients['totalDocPat'];
        }

        ?>
        <!-- Php -->

        <!-- Sidebar -->
        <?php
        include_once './Components/Sidebar.php';
        ?>
        <!-- Sidebar -->
        <?php if ($_SESSION['Role'] == 1) {
        ?>
            <div class="page-wrapper">
                <div class="content col-md-12" style="width: 100%; height: auto;">
                    <div>
                        <div class="container align-items-center" style="height: 85vh; display: flex;">
                            <div class="row justify-content-end ml-3 col-12">
                                <div class="col-md-6">
                                    <div class="dash-widget">
                                        <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                                        <div class="dash-widget-info text-right">
                                            <h3><?php echo $totalDocs; ?></h3>
                                            <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dash-widget">
                                        <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                                        <div class="dash-widget-info text-right">
                                            <h3><?php echo $totalPats; ?></h3>
                                            <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row justify-content-end col-6"> -->
                                <div class="col-md-6">
                                    <div class="dash-widget">
                                        <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                                        <div class="dash-widget-info text-right">
                                            <h3><?php echo $totalLocs; ?></h3>
                                            <span class="widget-title3">Locations <i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dash-widget">
                                        <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                                        <div class="dash-widget-info text-right">
                                            <h3><?php echo $totalApps; ?></h3>
                                            <span class="widget-title4">Appointments <i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($_SESSION['Role'] == 2) { ?>

            <div class="page-wrapper">
                <div class="content col-md-12" style="width: 100%; height: auto;">
                    <div>
                        <div class="container align-items-center" style="height: 85vh; display: flex;">
                            <div class="row justify-content-center ml-3 col-12">
                                <div class="col-md-6">
                                    <div class="dash-widget">
                                        <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                                        <div class="dash-widget-info text-right">
                                            <h3><?php echo $totalDocPats; ?></h3>
                                            <span class="widget-title2">My Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>




    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>



</html>