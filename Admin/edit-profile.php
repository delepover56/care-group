<!DOCTYPE html>
<html lang="en">

<!-- profile22:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Edit Profile - Care Groups</title>
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
        include_once './Components/Nav.php';
        ?>
        <!-- NavBar -->

        <!-- Php -->
        <?php
        // Get current user's ID from session
        $current_user_id = $_SESSION['id'];

        // Retrieve user's information from the database
        $sql = "SELECT * FROM user WHERE `id` = '$current_user_id'";
        $result = $conn->query($sql);

        // Check if the result contains any rows
        if ($result->num_rows > 0) {
            // Fetch the data and store it in variables
            $row = $result->fetch_assoc();
            $doc_name = $row['name'];
            $doc_email = $row['email'];
            $doc_phone = $row['phone'];
            $doc_city = $row['City'];
            $doc_edu = $row['Education'];
            $doc_spec = $row['Specialization'];
            $doc_avail = $row['Availability'];
        }

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get form data
            $name = $_POST['name'];
            $edu = $_POST['edu'];
            $spec = $_POST['spec'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            // Validation: Check if any field is empty
            if (empty($name) || empty($edu) || empty($spec) || empty($city) || empty($phone) || empty($email)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 51px; margin-left: 221px;" role="alert">
        <strong>Error!</strong> All fields are required.
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
                    // Update user profile in the database
                    $updateSql = "UPDATE `user` SET
            `name` = '$name',
            `Education` = '$edu',
            `Specialization` = '$spec',
            `City` = '$city',
            `phone` = '$phone',
            `email` = '$email'
            WHERE `id` = '$current_user_id'";
                    $updateResult = $conn->query($updateSql);

                    // Check if the update was successful
                    if ($updateResult) {
                        // Redirect to the user's profile page
                        header("location: ./profile.php");
                    }
                }
            }
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
                        <a href="profile.php" class="btn btn-light btn-rounded"><i class="fa fa-home"></i> Back to profile</a>
                    </div>
                </div>
                <div class="container col-6 py-5" style="height: 100%;">
                    <div class="card">
                        <form action="" method="POST">
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
                                <div class="row form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="name">Name:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="name" class="form-control" id="name" value="<?php echo $doc_name; ?>" style="border-radius: 20px;"></div>
                                </div>
                                <div class="row mt-3 form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="edu">Education:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="edu" class="form-control" id="edu" value="<?php echo $doc_edu; ?>" style="border-radius: 20px;"></div>
                                </div>
                                <div class="row mt-3 form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="spec">Speciality:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="spec" class="form-control" id="spec" value="<?php echo $doc_spec; ?>" style="border-radius: 20px; width: 260px;"></div>
                                </div>
                                <div class="mt-5">
                                    <hr class="col-md-9">
                                </div>
                                <div class="text-center my-5">
                                    <h3>Contact Information</h3>
                                </div>
                                <div class="row form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="city">City:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="city" class="form-control" id="city" value="<?php echo $doc_city; ?>" style="border-radius: 20px;"></div>
                                </div>
                                <div class="row mt-3 form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="phone">Phone:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="phone" class="form-control" id="phone" value="<?php echo $doc_phone; ?>" style="border-radius: 20px;"></div>
                                </div>
                                <div class="row mt-3 form-group">
                                    <div class="col-3" style="font-size: 18px;"><label for="email">Email:</label></div>
                                    <div style="font-size: 18px;"><input type="text" name="email" class="form-control" id="email" value="<?php echo $doc_email; ?>" style="border-radius: 20px; width: 260px;"></div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info" name="submit" style="border-radius: 20px; margin-top: 15px; font-size: 16px;">Save Changes</button>
                                </div>
                            </div>
                        </form>
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