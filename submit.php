<?php
// Database connection settings
$host = "sql103.infinityfree.com";
$username = "if0_37935192";
$password = "jscOyif944sOKD";
$dbname = "if0_37935192_student_registration";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!<br>";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize input
    $name = htmlspecialchars($_POST['name']);
    $usn = htmlspecialchars($_POST['usn']);
    $email = htmlspecialchars($_POST['email']);
    $dob = $_POST['dob'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    // Prepare SQL query to insert data
    $sql = "INSERT INTO students (name, usn, email, dob, course, gender, phone, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements for security
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssss", $name, $usn, $email, $dob, $course, $gender, $phone, $address);

        // Execute and check for success
        if ($stmt->execute()) {
            echo "Registration Successful!";
        } else {
            echo "Error during insertion: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "SQL Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
