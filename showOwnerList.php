<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
} 

$sql = "SELECT * FROM owner";
$result = mysqli_query($mysqli, $sql);

$num = mysqli_num_rows($result);
//echo $num;
echo "<br>";

if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['owner_nid']." Owner_name ". $row['owner_name']." Address ".$row['owner_address'];
        echo "<br>";
    }
}
else echo "কোনো মালিক যুক্ত করা হয় নি। "

?>
