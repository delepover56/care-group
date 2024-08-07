<?php
require_once './Components/config.php';
session_start();

if (!isset($_SESSION['Email']) && !isset($_SESSION['Password'])) {
    header("Location:login.php");
}

$person_id = $_SESSION['id'];

$personSql = "SELECT `name` FROM `user` WHERE `id` = '$person_id'";
$personResult = $conn->query($personSql);

if ($personResult->num_rows > 0) {
    $personRow = $personResult->fetch_assoc();
    $personName = $personRow['name'];
}
?>



<div class="header">
    <div class="header-left">
        <a href="./index.php" class="logo">
            <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Care</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="./assets/img/user.jpg" width="24" alt="Admin">
                    <span class="status online"></span>
                </span>
                <?php
                echo $personName;
                ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="login.php">Logout</a>
        </div>
    </div>
</div>