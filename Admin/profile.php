<!DOCTYPE html>
<html lang="en">

<!-- profile22:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Profile - Care Groups</title>
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
        // Get user's ID from the session
        $user_id = $_SESSION['id'];

        // Retrieve user's information from the database based on ID
        $sql = "SELECT * FROM user WHERE `id` = '$user_id'";
        $result = $conn->query($sql);

        // Check if the query returned any results
        if ($result->num_rows > 0) {
            // Fetch the first row (there should be only one result)
            $row = $result->fetch_assoc();

            // Store user's information in variables
            $doc_name = $row['name'];
            $doc_email = $row['email'];
            $doc_phone = $row['phone'];
            $doc_city = $row['City'];
            $doc_edu = $row['Education'];
            $doc_spec = $row['Specialization'];
            $doc_avail = $row['Availability'];
        }
        ?>


        <!-- Php -->

        <!-- Sidebar -->
        <?php
        include_once './Components/Sidebar.php';
        ?>
        <!-- Sidebar -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>

                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="edit-profile.php" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i> Edit
                            Profile</a>
                        <a href="change-password.php" class="btn btn-info btn-rounded"><i class="fa fa-key"></i> Change password</a>
                    </div>

                </div>
                <div class="container col-6 py-5" style="height: 100%;">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-body p-5">
                            <div class="text-center py-3">
                                <img src="./assets/img/user.jpg" alt="User" style="border-radius: 50%;">
                            </div>
                            <div>
                                <hr class="col-md-9">
                            </div>
                            <div class="text-center my-5">
                                <h3>Basic Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-3" style="font-size: 18px;">Name:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_name; ?></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3" style="font-size: 18px;">Education:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_edu; ?></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3" style="font-size: 18px;">Speciality:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_spec; ?></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3" style="font-size: 18px;">Availability:</div>
                                <div class="col3" style="font-size: 18px;"><?php if (empty($doc_avail)) {
                                                                                echo '-';
                                                                            } else {
                                                                                echo $doc_avail;
                                                                            } ?></div>
                            </div>
                            <div>
                                <hr class="col-md-9">
                            </div>
                            <div class="text-center my-5">
                                <h3>Contact Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-3" style="font-size: 18px;">City:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_city; ?></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3" style="font-size: 18px;">Phone:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_phone; ?></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3" style="font-size: 18px;">Email:</div>
                                <div class="col3" style="font-size: 18px;"><?php echo $doc_email; ?></div>
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
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->

</html>