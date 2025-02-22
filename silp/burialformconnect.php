<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include 'dbConnection.php';

// Handle file upload
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/burial/';
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        die("Failed to create upload directory");
    }
}

// Initialize $bdeathcert
$bdeathcert = '';

// Handle death certificate upload
if(isset($_FILES['bdeathcert']) && $_FILES['bdeathcert']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['bdeathcert'];
    $fileName = time() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        die("Error: Only PDF, JPG, JPEG, and PNG files are allowed");
    }
    
    if(move_uploaded_file($file['tmp_name'], $targetPath)) {
        $bdeathcert = $fileName;
    } else {
        die("Error uploading death certificate: " . error_get_last()['message']);
    }
}

// Capture form data and sanitize inputs
$bname = mysqli_real_escape_string($conn, $_POST['bname'] ?? '');
$bage = mysqli_real_escape_string($conn, $_POST['bage'] ?? '');
$bdatedeath = mysqli_real_escape_string($conn, $_POST['bdatedeath'] ?? '');
$bdatetime = mysqli_real_escape_string($conn, $_POST['bdatetime'] ?? '');
$bparish = mysqli_real_escape_string($conn, $_POST['bparish'] ?? '');
$blfuneral = mysqli_real_escape_string($conn, $_POST['blfuneral'] ?? '');
$breserve = mysqli_real_escape_string($conn, $_POST['breserve'] ?? '');
$bemail = mysqli_real_escape_string($conn, $_POST['bemail'] ?? '');
$bcontact = mysqli_real_escape_string($conn, $_POST['bcontact'] ?? '');

// Insert data into the burial table
$query = "INSERT INTO burial (full_name, age, date_of_death, funeral_date, parish, funeral_location, reserver_name, email, contact_no, death_certificate) 
VALUES ('$bname', '$bage', '$bdatedeath', '$bdatetime', '$bparish', '$blfuneral', '$breserve', '$bemail', '$bcontact', '$bdeathcert')";

// Execute the query and check for errors
if (mysqli_query($conn, $query)) {
    // Redirect to success page instead of returning JSON
    header('Location: success.php');
    exit();
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
}

// Close connection
mysqli_close($conn);
?>