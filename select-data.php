<?php
// Including the configuration file
require_once './admin/Components/config.php';

// Retrieving the location name from the POST request
$locname = $_POST['loc_name'];

// Checking if the location is 'All' and setting the condition accordingly
if ($locname != 'All') {
    $connd = "'$locname'";
} else {
    $connd = 0;
}

// Fetching doctors based on the selected location and role
$fetch_query = mysqli_query($conn, "SELECT * FROM user WHERE `City` = $connd && `Role` = 2");
$rows = mysqli_num_rows($fetch_query);

// Checking if there are rows in the result
if ($rows > 0) {
    // Looping through the fetched rows and displaying them in a table
    while ($row = mysqli_fetch_array($fetch_query)) {
?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['City']; ?></td>
            <td><?php echo $row['Education']; ?></td>
            <td><?php echo $row['Specialization']; ?></td>
            <td><?php echo $row['Availability']; ?></td>
            <td>
                <!-- Button to book an appointment (you may add appropriate functionality) -->
                <button class="btn btn-light"><a href="#appointment" class="text-dark"><b>Book Appointment</b></a></button>
            </td>
        </tr>
<?php
    }
}
?>