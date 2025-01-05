<?php
// Database connection details
$servername = "localhost";
$username = "meladma";
$password = "!8pmM$@tz";
$dbname = "ShopaholicsDB";

// Create conn
$conn = new mysqli($servername, $username, $password, $dbname);

// Check conn
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the Car_Needs_View to get data
$sql = "SELECT * FROM CAR_NEEDS_VIEW";
$result = $conn->query($sql);

// Check if query returns any rows
if ($result->num_rows > 0) {
    $data = [];
    // Fetch data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Return data as JSON
    echo json_encode($data);
} else {
    echo json_encode([]); // Return empty array if no data found
}

// Close the connection
$conn->close();
?>
