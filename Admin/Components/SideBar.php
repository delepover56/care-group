<?php
require_once './Components/config.php';
?>

<div class="sidebar " id="sidebar"">
    <div class=" sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="menu-title">Main</li>
            <?php
            if ($_SESSION['Role'] == 1 || 2) {
            ?>
                <li class="active">
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