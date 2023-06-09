<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
} 

$sql = "SELECT * FROM driver";
$result = mysqli_query($mysqli, $sql);

$num = mysqli_num_rows($result);
//echo $num;
echo "<br>";

if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['driver_nid']." Driver_name ". $row['driver_name']." Autorickshaw_number ".$row['autorickshaw_number']." Address ".$row['driver_address'];
        echo "<br>";
    }
}
echo "কোনো ড্রাইভার যুক্ত করা হয় নি। "

?>
