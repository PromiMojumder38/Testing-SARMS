<?php


if (empty($_POST["manager_nid"])) {
    die(" Manager NID Required !!");
}

if (empty($_POST["round_number"])) {
    die("Round Number Required !!");
}

if (empty($_POST["round_start_time"])) {
    die("Round Start Time Required !!");
}
if (empty($_POST["round_end_time"])) {
    die("Round End Time Required !!");
}

if (empty($_POST["round_date"])) {
    die("Round Date Required !!");
}

if (empty($_POST["round_area"])) {
    die("Round Area Required !!");
}



$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO round (round_number, round_date, round_start_time, round_end_time, round_area, manager_nid)
        VALUES (?, ?, ? ,?, ?,?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "ssssss",
    $_POST["round_number"],
    $_POST["round_date"],
    $_POST["round_start_time"],
    $_POST["round_end_time"],
    $_POST["round_area"], 
    $_POST["manager_nid"]
);

if ($stmt->execute()) {

    header("Location: index.php");
    exit;

}else if ($mysqli->errno == 1452) {
    echo "ম্যানেজারের এনআইডি সঠিক নয়।";
}
    else{
        if ($mysqli->errno === 1062) {
            die("Error: রাউন্ড নং পুনরাবৃত্তি হয়েছে।");
        } else {
            die($mysqli->error . " " . $mysqli->errno);
        }
    }



?>