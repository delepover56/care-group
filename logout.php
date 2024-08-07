<?php
require_once './Admin/Components/config.php';
session_start();
session_destroy();
header("location: ./Admin/login.php");
