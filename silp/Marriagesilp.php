<?php
// Capture URL parameters for church, date, and time
$selectedChurch = isset($_GET['church']) ? $_GET['church'] : '1';
$selectedDate = isset($_GET['date']) ? $_GET['date'] : 'Not specified';
$selectedTime = isset($_GET['time']) ? $_GET['time'] : 'Not specified';
$selectedDateTime = trim($selectedDate . ' ' . $selectedTime);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="folder/styless.css">
    <link rel="stylesheet" type="text/css" href="warning.css">
    <link rel="icon" href="ig.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILP Marriage Form</title>
    <link rel="stylesheet" href="folder/bootstrap.min.css">
    <link href="folder/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="folder/jquery.datetimepicker.css">
    <script src="folder/jquery-3.6.0.min.js"></script>
    <script src="folder/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>
<style>
    .custom-button {
        background-color: #8BECEC;
        color: black;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-weight: 800;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }

    .row button {
        width: 100px;
        /* Set the width to the desired value */
        padding: 10px 15px;
        font-size: 14px;
        margin-right: 10px;
        font-family: 'Montserrat', sans-serif;

    }

    .row {
        display: flex;
        justify-content: center;
    }

    .form-box {
        border: 2px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
        /* Adjust the margin as needed */
    }

    .form-title {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: left;
        color: #333;
        position: relative;
        padding-bottom: 10px;

    }

    .form-title::before {
        content: '';
        position: absolute;
        width: 260px;
        height: 4px;
        background-color: #007bff;
        bottom: 0;
        left: 0;
    }

    .form-title {
        font-size: 32px;
        font-family: 'Arial', sans-serif;
        /* Change the font-family here */
        font-weight: bold;
        margin-bottom: 20px;
        text-align: left;
        color: #333;
        position: relative;
        padding-bottom: 10px;
    }

    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }

    .short-btn {
        width: 30px;
        /* Adjust the width as needed */
        white-space: nowrap;
        /* Prevent text wrapping */
        overflow: hidden;
        /* Hide overflowed content */
        text-overflow: ellipsis;
        /* Display an ellipsis (...) when text overflows */
    }



    .main-content {
        overflow-y: auto;
        height: 100vh;
    }

    a {
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
    }

    a:hover {
        background-color: #AFEB38;
        color: black;
    }

    .previous {
        background-color: #931E04;
        color: white;
    }

    .next {
        background-color: #106497;
        color: white;
    }

    .round {
        border-radius: 50%;
    }

    body {
        font-family: Arial, sans-serif;
    }


    .requirement {
        margin-bottom: 15px;
    }

    .requirement label {
        display: block;
        margin-bottom: 5px;
    }

    .requirement input[type="file"] {
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Style for the required asterisk */
    .requirement span {
        color: red;
    }
</style>

<body>
    <!-- Add this popup HTML right after body tag -->
    <div class="popup-overlay" style="display: none;">
        <div class="warning-popup">
            <span class="close-btn">&times;</span>
            <p>Please upload according to type of file: pdf, jpg, jpeg and png. Thank you.</p>
            <button class="okay-btn">OK</button>
        </div>
    </div>
    <div class="main-container">
            <div class="main-content">
                <div class="top-bar">
                    <div class="profile">
                        <span>SILP MARRIAGE FORM</span>
                        
                    </div>
                </div>

                <div class="container py-5" id="page-container">

                                        
                        <div class="container py-5" id="page-container">
                            <div class="col-sm-12">
                                <div class="form-box">
                                    <div class="form-title">SILP MARRIAGE FORM <img src="ig.jpg" alt="Company Logo" width="100" height="100" style="float: right;"></div>
                                    <a href="silpcalendar.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                                    <form method="POST" action="marriageformconnect.php" enctype="multipart/form-data">
										<div class="form-group">
                                        <!-- Section 1: Update Section 1 content as needed -->
                                        <div class="form-section active" id="section-1">
                                            <h4>Section 1: Personal Details</h4>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6><b>Groom Information:</b></h6>
                                                    <hr style="height: 1px; border: none; background-color: #333;">
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6><b>Bride Information:</b></h6>
                                                    <hr style="height: 1px; border: none; background-color: #333;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhname" id="mhname" required placeholder="(ex. Juan D. Cruz)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwname" id="mwname" required placeholder="(ex. Anne C. Torres)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Date of Birth:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhbirth" required placeholder="Date of Birth" id="mhbirth" class="form-control pinaganak" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Date of Birth:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwbirth" required placeholder="Date of Birth" id="mwbirth" class="form-control pinaganak" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Place of Birth:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mhpbirth" id="mhpbirth" required placeholder="Place of Birth" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Place of Birth:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwpbirth" id="mwpbirth" required placeholder="Place of Birth" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhciti" id="mhciti" required placeholder="(ex. Filipino)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwciti" id="mwciti" required placeholder="(ex. Filipino)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Gender:<span style='color:red'> *</span></label>
                                                    <select name="mhsex" id="mhsex" required class="form-control">
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Gender:<span style='color:red'> *</span></label>
                                                    <select class="form-control" name="mwsex" id="mwsex" required>
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mhresidence" id="mhresidence" required placeholder="Residence" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwresidence" id="mwresidence" required placeholder="Residence" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Religion:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhreligion" id="mhreligion" required placeholder="(ex. Roman Catholic)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Religion:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mwreligion" id="mwreligion" required placeholder="(ex. Catholic)" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Civil Status:<span style='color:red'> *</span></label>
                                                    <select name="mhstatus" id="mhstatus" required class="form-control" onchange="selectSameCivilStatus(this)">
                                                        <option value="">Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Civil Status:<span style='color:red'> *</span></label>
                                                    <select name="mwstatus" id="mwstatus" required class="form-control">
                                                        <option value="">Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										<br>
                                            <h4>Section 2: Parents Details</h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6>Groom Parent Information:</h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>Bride Parent Information:</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Father's Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mhnamefather" id="mhnamefather" required placeholder="(ex. Jose A. Cruz)" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Father's Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwnamefather" id="mwnamefather" required placeholder="(ex. Lito A. Aguinaldo)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhcitizenshipfather" id="mhcitizenshipfather" required placeholder="(ex.Filipino)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mwcitizenshipfather" id="mwcitizenshipfather" required placeholder="(ex. Filipino)" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Mother's Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhnamemother" id="mhnamemother" required placeholder="(ex. Lita S. Cruz)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Mother's Full Name:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwnamemother" id="mwnamemother" required placeholder="(ex. Susan B. Aguinaldo)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="mhcitizenshipmother" id="mhcitizenshipmother" required placeholder="(ex. Filipino)" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Citizenship:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwcitizenshipmother" id="mwcitizenshipmother" required placeholder="(ex. Filipino)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Witness (Male):<span style='color:red'> *</span></label>
                                                    <input type="text" name="mwitness" id="mwitness" required placeholder="Person who gave consent" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Witness (Female):<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="fwitness" id="fwitness" required placeholder="Person who gave consent" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Relationship:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mhwrelation" id="mhwrelation" required placeholder="Relationship" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Relationship:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="fhwrelation" id="fhwrelation" required placeholder="Relationship" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" name="mresidence" id="mresidence" required placeholder="Residence" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" class="form-control" name="fresidence" id="fresidence" required placeholder="Residence" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                            </div>
											<br>
                                            <h4>Section 3: Requirements Needed</h4> <Br>
                                            <div class="row">
                                                <div class="requirement col-sm-6">
                                                    <h5><b>Groom Requirements:</b></h5>
                                                </div>
                                                <div class="requirement col-sm-6">
                                                    <h5><b>Bride Requirements:</b></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="requirement col-sm-6">
                                                    <label for="baptismalCertificate">Baptismal Certificate<span style='color:red'> *</span></label>
                                                    <input type="file" name="groom_baptismal_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                                <div class="requirement col-sm-6">
                                                    <label for="baptismalCertificate">Baptismal Certificate<span style='color:red'> *</span></label>
                                                    <input type="file" name="bride_baptismal_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="requirement col-sm-6">
                                                    <label for="confirmationCertificate">Confirmation Certificate<span style='color:red'>*</span></label>
                                                    <input type="file" name="groom_confirmation_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                                <div class="requirement col-sm-6">
                                                    <label for="confirmationCertificate">Confirmation Certificate<span style='color:red'>*</span></label>
                                                    <input type="file" name="bride_confirmation_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="requirement col-sm-6">
                                                    <label for="birthCertificate">Birth Certificate<span style='color:red'> *</span></label>
                                                    <input type="file" name="groom_birth_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                                <div class="requirement col-sm-6">
                                                    <label for="birthCertificate">Birth Certificate<span style='color:red'> *</span></label>
                                                    <input type="file" name="bride_birth_cert" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="requirement col-sm-6">
                                                    <label for="cenomar">Certificate of No Marriage (CENOMAR)<span style='color:red'> *</span></label>
                                                    <input type="file" name="groom_cenomar" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>

                                                <div class="requirement col-sm-6">
                                                    <label for="cenomar">Certificate of No Marriage (CENOMAR)<span style='color:red'> *</span></label>
                                                    <input type="file" name="bride_cenomar" accept=".pdf,.jpg,.jpeg,.png" required>
                                                </div>
                                            </div>
											<br>
                                            <h4>Section 4: Schedule Information</h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="birthCertificate">Reserve By: <span style='color:red'> *</span></label>
                                                    <input type="text" name="reserv eby" id="reserveby" required placeholder="Reserve by (ex. Juan Cruz)" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="birthCertificate">Email Address <span style='color:red'>*</span></label>
                                                    <input type="text" name="email" id="email" required placeholder="(ex. juan@gmail.com" class="form-control" />
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <label for="mnumber">Phone Number: <span style='color:red'> *</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">+63</span>
                                                        <input type="tel" id="mnumber" name="mnumber" required maxlength="10" placeholder="XXXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="mnoguest">Number of Guest: <span style='color:red'> *</span></label>
                                                    <input type="number" name="mnoguest" id="mnoguest" required placeholder="Number of guests expected" class="form-control" required />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="row">
                                                <div class="col-sm-12">
    <label for="marriageloc">Place of Marriage:<span style="color:red"> *</span></label><br>
    <select id="marriageloc" name="marriageloc" class="form-control" aria-label="Place of Marriage">
    <optgroup label="Choose your preferred Parish:">
            <option value="St. Ignatius of Loyola Parish" <?php if ($selectedChurch == "St. Ignatius of Loyola Parish") echo "selected"; ?>>St. Ignatius of Loyola Parish</option>
        </optgroup>
    </select>
</div>
												</div>
                                                <div class="col-sm-3">
                                                <label for="priest">Name of Priest: (if you preferred any priest)</label>
                                                <input type="text" name="priest" id="priest" class="form-control" />
                                                </div>
                                                <div class="row">
        <h4><b>Schedule Information:</b></h4>
        <div class="col-sm-3">
            <label for="mdatetime_display">Date & Time:<span style="color:red"> *</span></label>
            <input type="text" name="mdatetime_display" id="mdatetime_display" required placeholder="Date & Time" class="form-control" disabled
                   value="<?php echo htmlspecialchars($selectedDateTime); ?>" aria-label="Selected Date and Time">
            <input type="hidden" name="mdatetime" id="mdatetime" value="<?php echo htmlspecialchars($selectedDateTime); ?>" class="form-control">
        </div>
        <br><br>


                                                <div class="col-sm-3">
                                                    <label>Select Event Type:<span style='color:red'> *</span></label>
                                                    <select name="marriagetype" id="marriagetype" class="form-control">
                                                        <option>Regular</option>
                                                        <option>Special (Kasalang Bayan)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <hr style="border-top: 1px solid black;">

                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" id="submitButton" class="btn btn-lg custom-button">SUBMIT</button>
                                            </div>

                                        </div>
                                        <br>

                                                                    </div>
                                </form>


                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header  bg-success">
                                        <h4 class="modal-title">Modal title</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body-1"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
</body>
<script>
    function capitalizeFirstLetter(input) {
        let value = input.value;
        input.value = value.charAt(0).toUpperCase() + value.slice(1);
    }
</script>
<script>
    function selectSameCivilStatus(selectElement) {
        var selectedValue = selectElement.value;
        var otherSelect = document.getElementById("mwstatus");

        // Find the option with the same value in the other select element
        var optionToSelect = Array.from(otherSelect.options).find(option => option.value === selectedValue);

        if (optionToSelect) {
            otherSelect.value = optionToSelect.value;
        }
    }
</script>
<script>
    $(document).ready(function() {
        var currentYear = new Date().getFullYear();
        var yearRange = currentYear - 1990;

        $("#pinaganako").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-18y', // Adjust the start date to cover a wider range
            endDate: '-18y',
            autoclose: true
        });

        $("#pinaganakosay").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-18y', // Adjust the start date to cover a wider range
            endDate: '-18y',
            autoclose: true
        });

        $("#pinaganako").datepicker('setStartDate', '-' + yearRange + 'y');
        $("#pinaganakosay").datepicker('setStartDate', '-' + yearRange + 'y');
        var oneWeekBefore = new Date();
        oneWeekBefore.setDate(oneWeekBefore.getDate() + 7);
        jQuery('#dateAndTime_hus, #dateAndTime_wife').datetimepicker({
            format: 'Y-m-d g:i A',
            step: 30,
            timepicker: true,
            minDate: oneWeekBefore
        });

        function toggleSubmitButton(enable) {
            if (enable) {
                $("#submitButton").prop("disabled", false);
            } else {
                $("#submitButton").prop("disabled", true);
            }
        }

        $("#dateAndTime, #event_type").on("change", function() {
            var selectedDateTime = $("#dateAndTime").val();
            var eventType = $("#event_type").val();

            $.ajax({
                url: "php/fetch_available_schedules_wedding.php",
                method: "POST",
                data: {
                    selectedDateTime: selectedDateTime,
                    eventType: eventType
                },
                success: function(data) {
                    $("#availableSchedules").html("Available Schedules: " + data);
                    var availableCount = parseInt(data);
                    toggleSubmitButton(availableCount > 0);
                },
                error: function() {
                    $("#availableSchedules").html("Error fetching available schedules.");
                    toggleSubmitButton(false);
                }
            });
        });

        const sections = document.querySelectorAll('.form-section');
        let currentSection = 0;
        const nextButton = document.getElementById('nextSection');

        function showSection(sectionIndex) {
            sections.forEach((section, index) => {
                if (index === sectionIndex) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });

            if (sectionIndex === sections.length - 1) {
                nextButton.disabled = true;
            } else {
                nextButton.disabled = false;
            }
        }

        document.getElementById('nextSection').addEventListener('click', () => {
            if (currentSection < sections.length - 1) {
                currentSection++;
                showSection(currentSection);
            }
        });

        document.getElementById('prevSection').addEventListener('click', () => {
            if (currentSection > 0) {
                currentSection--;
                showSection(currentSection);
            }
        });

        showSection(currentSection);
    });
</script>
<script>
    document.getElementById('number').addEventListener('input', function() {
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 10); // Limit input to 11 characters
        }
    });
</script>

<script src="folder/notification.js"></script>
<script src="folder/my_script.js"></script>
<script src="folder/jquery.min.js"></script>
<script src="folder/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="folder/jquery.datetimepicker.full.js"></script>

<script>
    function validateFileSize() {
        const maxSize = 40 * 1024 * 1024; // 40MB in bytes
        let totalSize = 0;
        
        // Get all file inputs
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        // Calculate total size
        fileInputs.forEach(input => {
            if (input.files.length > 0) {
                totalSize += input.files[0].size;
            }
        });
        
        if (totalSize > maxSize) {
            alert('Total file size exceeds 40MB. Please reduce file sizes before uploading.');
            return false;
        }
        return true;
    }

    // Add validation to your form
    document.querySelector('form').onsubmit = validateFileSize;
</script>

<script>
    // Add file type validation to all file inputs
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && !file.type.match('application/pdf|image/jpeg|image/jpg|image/png')) {
                showWarning();
                this.value = ''; // Clear the input
            }
        });
    });

    // Show popup
    function showWarning() {
        document.querySelector('.popup-overlay').style.display = 'block';
    }

    // Hide popup 
    function hideWarning() {
        document.querySelector('.popup-overlay').style.display = 'none';
    }

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Close button event listener
        document.querySelector('.close-btn').addEventListener('click', hideWarning);

        // OK button event listener
        document.querySelector('.okay-btn').addEventListener('click', hideWarning);

        // Close on overlay click (optional)
        document.querySelector('.popup-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                hideWarning();
            }
        });
    });
</script>

</body>
</html>