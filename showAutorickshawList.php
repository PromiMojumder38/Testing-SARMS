<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
} 

$sql = "SELECT * FROM autorickshaw";
$result = mysqli_query($mysqli, $sql);

$num = mysqli_num_rows($result);
//echo $num;
echo "<br>";

if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['autorickshaw_number']." owner's NID ". $row['owner_nid']." Autorickshaw_model ".$row['autorickshaw_model']." Company ".$row['autorickshaw_company']." Color ".$row['autorickshaw_color'];
        echo "<br>";
    }
}
else echo "কোনো অটোরিকশা যুক্ত করা হয় নি। "

?>
