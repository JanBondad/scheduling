<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'u493132415_pasiginaenae');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle file upload
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/matrimony/';
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        die("Failed to create upload directory");
    }
}

// Initialize document variables
$groom_birth_cert = '';
$groom_baptismal_cert = '';
$groom_confirmation_cert = '';
$groom_cenomar = '';
$bride_birth_cert = '';
$bride_baptismal_cert = '';
$bride_confirmation_cert = '';
$bride_cenomar = '';

// Handle file uploads for multiple documents
$documents = [
    'groom_birth_cert' => 'groom_birth_certificate',
    'groom_baptismal_cert' => 'groom_baptismal_certificate',
    'groom_confirmation_cert' => 'groom_confirmation_certificate',
    'groom_cenomar' => 'groom_cenomar',
    'bride_birth_cert' => 'bride_birth_certificate',
    'bride_baptismal_cert' => 'bride_baptismal_certificate',
    'bride_confirmation_cert' => 'bride_confirmation_certificate',
    'bride_cenomar' => 'bride_cenomar'
];

foreach ($documents as $fileKey => $dbField) {
    if(isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES[$fileKey];
        $fileName = time() . '_' . $dbField . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        
        // Check file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!in_array($file['type'], $allowedTypes)) {
            die("Error: Only PDF, JPG, JPEG, and PNG files are allowed for $dbField");
        }
        
        if(move_uploaded_file($file['tmp_name'], $targetPath)) {
            $$fileKey = $fileName;
        } else {
            die("Error uploading $dbField: " . error_get_last()['message']);
        }
    }
}

// Capture form data and sanitize inputs
$mhname = mysqli_real_escape_string($con, $_POST['mhname'] ?? '');
$mwname = mysqli_real_escape_string($con, $_POST['mwname'] ?? '');
$mhbirth = mysqli_real_escape_string($con, $_POST['mhbirth'] ?? '');
$mwbirth = mysqli_real_escape_string($con, $_POST['mwbirth'] ?? '');
$mhpbirth = mysqli_real_escape_string($con, $_POST['mhpbirth'] ?? '');
$mwpbirth = mysqli_real_escape_string($con, $_POST['mwpbirth'] ?? '');
$mhciti = mysqli_real_escape_string($con, $_POST['mhciti'] ?? '');
$mwciti = mysqli_real_escape_string($con, $_POST['mwciti'] ?? '');
$mhsex = mysqli_real_escape_string($con, $_POST['mhsex'] ?? '');
$mwsex = mysqli_real_escape_string($con, $_POST['mwsex'] ?? '');
$mhresidence = mysqli_real_escape_string($con, $_POST['mhresidence'] ?? '');
$mwresidence = mysqli_real_escape_string($con, $_POST['mwresidence'] ?? '');
$mhreligion = mysqli_real_escape_string($con, $_POST['mhreligion'] ?? '');
$mwreligion = mysqli_real_escape_string($con, $_POST['mwreligion'] ?? '');
$mhstatus = mysqli_real_escape_string($con, $_POST['mhstatus'] ?? '');
$mwstatus = mysqli_real_escape_string($con, $_POST['mwstatus'] ?? '');
$mhnamefather = mysqli_real_escape_string($con, $_POST['mhnamefather'] ?? '');
$mwnamefather = mysqli_real_escape_string($con, $_POST['mwnamefather'] ?? '');
$mhcitizenshipfather = mysqli_real_escape_string($con, $_POST['mhcitizenshipfather'] ?? '');
$mwcitizenshipfather = mysqli_real_escape_string($con, $_POST['mwcitizenshipfather'] ?? '');
$mhnamemother = mysqli_real_escape_string($con, $_POST['mhnamemother'] ?? '');
$mwnamemother = mysqli_real_escape_string($con, $_POST['mwnamemother'] ?? '');
$mhcitizenshipmother = mysqli_real_escape_string($con, $_POST['mhcitizenshipmother'] ?? '');
$mwcitizenshipmother = mysqli_real_escape_string($con, $_POST['mwcitizenshipmother'] ?? '');   
$mwitness = mysqli_real_escape_string($con, $_POST['mwitness'] ?? '');
$fwitness = mysqli_real_escape_string($con, $_POST['fwitness'] ?? '');
$mhwrelation = mysqli_real_escape_string($con, $_POST['mhwrelation'] ?? '');
$fhwrelation = mysqli_real_escape_string($con, $_POST['fhwrelation'] ?? '');
$mresidence = mysqli_real_escape_string($con, $_POST['mresidence'] ?? '');
$fresidence = mysqli_real_escape_string($con, $_POST['fresidence'] ?? '');
$groom_baptismal_cert = mysqli_real_escape_string($con, $_POST['groom_baptismal_cert'] ?? '');
$bride_baptismal_cert = mysqli_real_escape_string($con, $_POST['bride_baptismal_cert'] ?? '');
$groom_confirmation_cert = mysqli_real_escape_string($con, $_POST['groom_confirmation_cert'] ?? '');
$bride_confirmation_cert = mysqli_real_escape_string($con, $_POST['bride_confirmation_cert'] ?? '');       
$groom_birth_cert = mysqli_real_escape_string($con, $_POST['groom_birth_cert'] ?? '');
$bride_birth_cert = mysqli_real_escape_string($con, $_POST['bride_birth_cert'] ?? ''); 
$groom_cenomar = mysqli_real_escape_string($con, $_POST['groom_cenomar'] ?? '');
$bride_cenomar = mysqli_real_escape_string($con, $_POST['bride_cenomar'] ?? '');   
$reserveby = mysqli_real_escape_string($con, $_POST['reserveby'] ?? '');
$email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
$mnumber = mysqli_real_escape_string($con, $_POST['mnumber'] ?? '');
$mnoguest = mysqli_real_escape_string($con, $_POST['mnoguest'] ?? '');
$marriageloc = mysqli_real_escape_string($con, $_POST['marriageloc'] ?? '');
$priest = mysqli_real_escape_string($con, $_POST['priest'] ?? '');
$mdatetime = mysqli_real_escape_string($con, $_POST['mdatetime'] ?? '');
$marriagetype = mysqli_real_escape_string($con, $_POST['marriagetype'] ?? '');

// Insert data into the marriage table
$query = "INSERT INTO matrimony (
    groom_name, bride_name, dob_groom, dob_bride, pob_groom, pob_bride, 
    address_groom, address_bride, religion_groom, religion_bride, 
    fathername_groom, fathername_bride, mothername_groom, mothername_bride, 
    witness_male, witness_female, relation_male, relation_female, 
    confirmation_groom, baptismal_groom, birthcert_groom, 
    confirmation_bride, baptismal_bride, birthcert_bride, 
    reserve_name, email, phone_number, no_of_guest, 
    parish, priest, date_time, event_type
) VALUES (
    '$mhname', '$mwname', '$mhbirth', '$mwbirth', '$mhpbirth', '$mwpbirth', 
    '$mhresidence', '$mwresidence', '$mhreligion', '$mwreligion', 
    '$mhnamefather', '$mwnamefather', '$mhnamemother', '$mwnamemother', 
    '$mwitness', '$fwitness', '$mhwrelation', '$fhwrelation', 
    '$groom_confirmation_cert', '$groom_baptismal_cert', '$groom_birth_cert', 
    '$bride_confirmation_cert', '$bride_baptismal_cert', '$bride_birth_cert', 
    '$reserveby', '$email', '$mnumber', '$mnoguest', 
    '$marriageloc', '$priest', '$mdatetime', '$marriagetype'
)";
// Execute the query and check for errors
if (mysqli_query($con, $query)) {
    // Redirect to success page instead of returning JSON
    header('Location: success.php');
    exit();
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
}

// Close connection
mysqli_close($con);
?>