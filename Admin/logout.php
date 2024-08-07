<?php

// Include the configuration file
require_once './Components/config.php';

// Start a new or resume the existing session
session_start();

// Destroy all data registered to a session (logging out the user)
session_destroy();

// Redirect to the login page after destroying the session
header("Location: ./login.php");
exit(); // Ensure that no further code is executed after the redirect
