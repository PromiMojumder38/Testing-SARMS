<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>ড্রাইভারের নিবন্ধন ফর্ম</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap');

* {
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    background:#cdceb4;
    padding: 0 20px 0 20px;
}

.main {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.row {
    width: 900px;
    height: 600px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.2);
}

.side-image {
    background-image: url("images/10.jpg");
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
    border-radius: 10px 0 0 10px;
}


img {
    width: 35px;
    position: absolute;
    top: 30px;
    left: 30px;
}

.right {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.input-box {
    width: 330px;
    box-sizing: border-box;
}

.input-box header {
    font-weight: 700;
    text-align: center;
    margin-bottom: 32px;
    font-size: 27px;
    margin-top: 10px;
}

.input-field {
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 0 10px 0 10px;
    
}

.input {
    height: 35px;
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    
    outline: none;
    margin-top: 5px;
    margin-bottom: 20px;
    color: #40414a;
}

.input-box .input-field label {
    position: absolute;
    top: 10px;
    font-size: 15px;
    font-weight: 500;
    left: 10px;
    pointer-events: none;
    transition: .5s;
    color: #797676f1;
}

.input-field .input:focus~label {
    top: -10px;
    font-size: 13px;
}

.input-field .input:valid~label {
    top: -10px;
    font-size: 13px;
    color: #5d5076;
}

.input-field .input:focus,
.input-field .input:valid {
    border-bottom: 1px solid #743ae1;
}

.submit {
    border: none;
    outline: none;
    height: 45px;
    background: #ececec;
    border-radius: 5px;
    transition: .4s;
    background: rgba(154, 156, 37, 0.9);
    font-weight: 500;
   
}

.submit:hover {
    background: rgba(37, 95, 156, 0.9);
    color: #fff;
}

.signin {
    text-align: center;
    font-size: 12px;
    margin-top: 15px;
    margin-bottom: 20px;
}

span a {
    text-decoration: none;
    font-weight: 700;
    color: #000;
    transition: .5s;
}

span a:hover {
    text-decoration: underline;
    color: #000;
}

@media only screen and (max-width: 768px) {
    .side-image {
        border-radius: 10px 10px 0 0;
    }

    img {
        width: 35px;
        position: absolute;
        top: 20px;
        left: 47%;
    }

    .text {
        position: absolute;
        top: 70%;
        text-align: center;
    }

    .text p,
    i {
        font-size: 17px;
    }

    .row {
        max-width: 420px;
        width: 100%;
    }
}
</style>
</head>

<body>
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $driver_nid = $_POST["driver_nid"];
        $driver_name = $_POST["driver_name"];
        $driver_date_of_birth = $_POST["driver_date_of_birth"];
        $driver_houseNo = $_POST["driver_houseNo"];
        $driver_postalCode = $_POST["driver_postalCode"];
        $driver_address = $_POST["driver_address"];

        if (empty($driver_nid) || empty($driver_name) || empty($driver_date_of_birth) || empty($driver_houseNo) || empty($driver_postalCode) || empty($driver_address)) {
            die("All fields are required!");
        }

        if (strlen($driver_nid) != 10) {
            die("Wrong driver NID (Must be of 10 characters)!");
        }

        // Database connection
        $host = "localhost";
        $dbname = "login_db";
        $username = "root";
        $password = "";
        
        $mysqli = new mysqli($host, $username, $password, $dbname);
        
        if ($mysqli->connect_errno) {
            die("Connection error: " . $mysqli->connect_error);
        } 
        $stmt = $mysqli->prepare("INSERT INTO driver (driver_nid, driver_name, driver_date_of_birth, driver_houseNo, driver_postalCode, driver_address) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("ssssss", $driver_nid, $driver_name, $driver_date_of_birth, $driver_houseNo, $driver_postalCode, $driver_address);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            if ($mysqli->errno === 1062) {
                echo "Error: একই এনআইডিধারী ব্যক্তি একাধিকবার রেজিস্ট্রেশন করতে পারবে না।";
            } else {
                echo "Error: " . $mysqli->error;
            }
        }

        $stmt->close();
        $mysqli->close();
    }
    ?>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>ড্রাইভারের নিবন্ধন ফর্ম</header>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="driver-registration" novalidate>

                            <div class="input-field">
                                <input type="text" class="input" id="driver_nid" name = "driver_nid" required>
                                <label for="driver_nid">জাতীয় পরিচয়পত্র নম্বর</label>
                            </div>
                            <div class="input-field">
                                <input type="text" class="input" id="driver_name" name = "driver_name" required>
                                <label for="driver_name">ম্যানেজারের নাম</label>
                            </div>
                            <div class="input-field">
                                <input type="text" class="input" id="driver_date_of_birth" name = "driver_date_of_birth" pattern="\d{4}-\d{2}-\d{2}" required>
                                <label for="driver_date_of_birth">জন্ম তারিখ (YYYY-MM-DD)</label>
                            </div>
                            <div class="input-field">
                                <input type="text" class="input" name = "driver_houseNo" id="driver_houseNo" required>
                                <label for="driver_houseNo">বর্তমান ঠিকানা : বাড়ি নং</label>
                            </div>

                            <div class="input-field">
                                <input type="text" class="input" id="driver_postalCode" name = "driver_postalCode" required>
                                <label for="driver_postalCode">বর্তমান ঠিকানা : পোস্টাল কোড
                                </label>
                            </div>
                            <div class="input-field">
                                <input type="text" class="input" id="driver_address" name = "driver_address" required>
                                <label for="driver_address">বর্তমান ঠিকানা :জেলা</label>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" value="নিবন্ধন">

                            </div>

                        </form>

                        <div class="signin">
                            <span>পূর্বে রেজিস্ট্রেশন করেছেন? <a href="#">এড়িয়ে যান</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>