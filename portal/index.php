<?php
$servername = "localhost";
$username = "develope_seminar";
$password = "myseMinar2017";
$dbname = "develope_seminar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT `user_id`, `password`, `firstname`, `lastname`, `user_type` FROM `users` WHERE 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row['user_id']. " - Name: " . $row['firstname']. " " . $row['lastname']. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>