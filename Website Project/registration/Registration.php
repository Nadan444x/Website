<?php
// Database connection details
$host = 'localhost';
$dbname = 'website';
$username = 'root'; // Default username for XAMPP/WAMP
$password = ''; // Default password for XAMPP/WAMP

// Connect to the database
try {
    $conn = new PDO("mysql:host=$localhost;dbname=$website", $nadan,$Rohit@444);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['name']);
    $User_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);
    $confirm_password =trim($_POST['confirm_password']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);

    // Validate input
    if (empty($Fullname) || empty($User_name) || empty($password) || empty($confirm_password) || empty($dob) || empty($gender)) {
        die("All fields are required.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    try {
        $stmt = $conn->prepare("INSERT INTO registation_data(Full_Name,User_Name,Password_1,Confirm_Password,date_of_birth,Gender) VALUES (:name, :email, :password)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
        ]);

        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') { // Duplicate entry error
            die("Email already exists.");
        } else {
            die("Error: " . $e->getMessage());
        }
    }
}
?>