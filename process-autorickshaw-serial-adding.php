<?php


if (empty($_POST["autorickshaw_number"])) {
    die(" Auto-Rickshaw Number Required !!");
}

if (empty($_POST["round_number"])) {
    die("Round Number Required !!");
}

if (empty($_POST["serial_time"])) {
    die(" Serial Time Required !!");
}

if (empty($_POST["serial_date"])) {
    die("Serial Date Required !!");
}

if (empty($_POST["serial_status"])) {
    die("Serial Status Required !!");
}



$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO serial (serial_number, serial_time, serial_date, serial_status, autorickshaw_number, round_number)
        VALUES (?, ?, ? ,?, ?,?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "ssssss",
    $_POST["serial_number"],
    $_POST["serial_time"],
    $_POST["serial_date"],
    $_POST["serial_status"],
    $_POST["autorickshaw_number"],
    $_POST["round_number"]
);
$autorickshawNumber = $_POST['autorickshaw_number'];
$roundNumber = $_POST['round_number'];
if ($stmt->execute()) {

    header("Location: index.php");
    exit;

} else if($mysqli->errno == 1452) {
    echo "অটোরিকশা বা রাউন্ড নাম্বারটি পূর্বে এন্ট্রি করা হয় নি। অনুগ্রহ করে পুনরায় চেক করুন";
} 
 else {
        die($mysqli->error . " " . $mysqli->errno);
}


?>