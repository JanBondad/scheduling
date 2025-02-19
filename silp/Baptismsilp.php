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
        <title>SILP Baptismal Form</title>
        <link rel="stylesheet" href="folder/bootstrap.min.css">
        <link href="folder/bootstrap-datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="folder/jquery.datetimepicker.css">
        <script src="folder/jquery-3.6.0.min.js"></script>
        <script src="folder/bootstrap.min.js"></script>

        <script>
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

    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            width: 290px;
            height: 4px;
            background-color: #007bff;
            /* Choose your desired color */
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

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: powderblue !important;
            border-style: solid;
            border-width: 1px !important;
        }

        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            /* Hide scrollbars */
        }

        .dashboard-container {
            display: flex;
            flex-direction: row;
        }

        .sidebar {
            width: 290px;
        }

        .flashited {
            color: #f2f;
            -webkit-animation: flash linear 1s infinite;
            animation: flash linear 1s infinite;
        }

        @-webkit-keyframes flash {
            0% {
                opacity: 1;
            }

            50% {
                opacity: .1;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes flash {
            0% {
                opacity: 1;
            }

            50% {
                opacity: .1;
            }

            100% {
                opacity: 1;
            }
        }

        .short-btn {
            width: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-container {
            max-height: 80vh;
            /* Adjust the height as needed */
            overflow: auto;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
        }

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

        .custom-button:hover {
            background-color: #45a049;
            /* Darker green background color on hover */
        }

        .warning-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    max-width: 400px;
    text-align: center;
    border-left: 6px solid #ffa502;
    animation: slideIn 0.3s ease-out;
}

.warning-popup::before {
    content: "⚠️";
    display: block;
    font-size: 24px;
    margin-bottom: 10px;
}

.warning-popup p {
    color: #2f3542;
    font-size: 16px;
    margin: 0;
    line-height: 1.5;
}

.warning-popup .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #747d8c;
}

/* Optional overlay background */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translate(-50%, -60%);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

.okay-btn {
    background-color: #ffa502;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 15px;
    transition: background-color 0.3s;
}

.okay-btn:hover {
    background-color: #ff9f00;
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
        <div class="main-content">
            <div class="top-bar">
                <div class="profile">
                    <span>SILP BAPTISMAL FORM</span>
                  
                </div>
            </div>

            <div class="container py-5" id="page-container">

                                                
                    <div class="container py-5" id="page-container">
                        <div class="col-sm-12">
                            <div class="form-box">
                                <div class="form-title">SILP BAPTISMAL FORM <img src="ig.jpg" alt="Diocese Logo" width=100" height="100" style="float: right;"> </div>
                                <a href="silpcalendar.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                                <form action="baptismalformconnect.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
								<div class="form-group">
                                    <div>
                                        <div class="row">
                                            <h4><b>Child Information:</b></h4>
                                            <div class="col-sm-4">
                                                <label for="bapfname">First Name:<span style="color:red"> *</span></label>
                                                <input type="text" id="bapfname" name="bapfname" class="form-control" required placeholder="First Name of Child" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="bapmname">Middle Name:<span style="color:red"> </span></label>
                                                <input type="text" id="bapmname" name="bapmname" class="form-control" placeholder="Middle Name of Child" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="baplname">Last Name:<span style="color:red"> *</span></label>
                                                <input type="text" id="baplname" name="baplname" class="form-control" required placeholder="Last Name of Child" />
                                            </div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="bapdbirth">Date of Birth:<span style="color:red"> *</span></label>
                                                <input type="text" name="bapdbirth" id="bapdbirth" class="form-control" placeholder="Date of Birth">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="bappbirth">Place of Birth:<span style="color:red"> *</span></label>
                                                <input type="text" name="bappbirth" id="bappbirth" placeholder="Place of Birth" class="form-control" />
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="bapnationality">Nationality:<span style="color:red"> *</span></label>
                                                <input type="text" name="bapnationality" id="bapnationality" required placeholder="Nationality" class="form-control" />
                                            </div>
                                        </div> <br>
                                        <hr style="border-top: 2px solid black;">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4><b>Parents Information:</b></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="ffname">First Name:<span style="color:red"> *</span></label>
                                            <input type="text" id="ffname" name="ffname" placeholder="Father's First Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="fmname">Middle Name:<span style="color:red"> </span></label>
                                            <input type="text" id="fmname" name="fmname" placeholder="Father's Middle Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="flname">Last Name:<span style="color:red"> *</span></label>
                                            <input type="text" id="flname" name="flname" placeholder="Father's Last Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="bapfpbirth">Place of Birth:<span style="color:red"> </span></label>
                                            <input type="text" id="bapfpbirth" name="bapfpbirth" placeholder="Father's Place of Birth" class="form-control" />
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="fresidence">Residence:<span style='color:red'> *</span></label>
                                            <input type="text" id="fresidence" name="fresidence" placeholder="Parent's Recidence" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="bapfstatus">Civil Status:<span style="color:red"> *</span></label>
                                            <select name="bapfstatus" id="bapfstatus" class="form-control">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="mfname">First Name:<span style="color:red"> *</span></label>
                                            <input type="text" id="mfname" name="mfname" placeholder="Mother's First Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="mmname">Middle Name:<span style="color:red"> </span></label>
                                            <input type="text" id="mmname" name="mmname" placeholder="Mother's Middle Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="mlname">Last Name:<span style="color:red"> *</span></label>
                                            <input type="text" id="mlname" name="mlname" placeholder="Mother's Last Name" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="bapmpbirth">Place of Birth:<span style="color:red"> </span></label>
                                            <input type="text" id="bapmpbirth" name="bapmpbirth" required placeholder="Mother's Place of Birth" class="form-control" />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="mresidence">Residence:<span style='color:red'> *</span></label>
                                            <input type="text" id="mresidence" name="mresidence" required placeholder="Parent's Recidence" class="form-control" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="bapmstatus">Civil Status:<span style="color:red"> *</span></label>
                                            <select name="bapmstatus" id="bapmstatus" required class="form-control">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="mpsponsors">Principal Sponsors (Male):<span style='color:red'> *</span></label>
                                            <input class="form-control" name="mpsponsors" id="mpsponsors" placeholder="Sponsors (e.g., Godfather: Juan Dela Cruz)" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="fpsponsors">Principal Sponsors (Female):<span style='color:red'> *</span></label>
                                            <input class="form-control" name="fpsponsors" id="fpsponsors" placeholder="Sponsors (e.g., Godfather: Juan Dela Cruz)" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="sponsors3">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors3" id="sponsors3" placeholder="Optional" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="sponsors4">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors4" id="sponsors4" placeholder="Optional" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="sponsors5">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors5" id="sponsors5" placeholder="Optional" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="sponsors6">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors6" id="sponsors6" placeholder="Optional" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="sponsors7">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors7" id="sponsors7" placeholder="Optional" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="sponsors8">Sponsors:<span style='color:red'> </span></label>
                                            <input class="form-control" name="sponsors8" id="sponsors8" placeholder="Optional" />
                                        </div>
                                    </div>
                                    <br>
                                    <hr style="border-top: 2px solid black;">
                                    <div class="row">
                                    <hr style="border-top: 2px solid black;">
    <div class="row">
        <h4><b>Schedule Information:</b></h4>
        <div class="col-sm-3">
            <label for="bapdatetime_display">Date & Time:<span style="color:red"> *</span></label>
            <input type="text" name="bapdatetime_display" id="bapdatetime_display" required placeholder="Date & Time" class="form-control" disabled
                   value="<?php echo htmlspecialchars($selectedDateTime); ?>" aria-label="Selected Date and Time">
            <input type="hidden" name="bapdatetime" id="bapdatetime" value="<?php echo htmlspecialchars($selectedDateTime); ?>" class="form-control">
        </div>
        <br><br>
        <div class="row">
            <div class="col-sm-12">
              <!-- Place of Baptism Selection with pre-selected option based on the selectedChurch variable -->
<div class="col-sm-12">
    <label for="baploc">Place of Baptism:<span style="color:red"> *</span></label><br>
    <select id="baploc" name="baploc" class="form-control" aria-label="Place of Baptism">
        <optgroup label="Choose your preferred Parish:">
            <option value="St. Ignatius of Loyola Parish" <?php if ($selectedChurch == "St. Ignatius of Loyola Parish") echo "selected"; ?>>St. Ignatius of Loyola Parish</option>
        </optgroup>

    </select>
</div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-4 mb-3">
												<label for="bapriest" class="form-label">Name Of Priest: (if you preferred any priest, if not leave it blank) </label>
												<input type="text" id="bapriest" name="bapriest" class="form-control"/>
												</div>
                                                <div class="col-sm-4 mb-3">
                                                    <label for="bapemail" class="form-label">Email Address:<span style="color:red"> *</span></label>
                                                    <input type="email" id="bapemail" name="bapemail" required placeholder="Enter your email address" class="form-control">
                                                </div>

                                                <div class="col-sm-4 mb-3">
                                                    <label for="bapcontact" class="form-label">Contact Number:<span style="color:red"> *</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">+63</span>
                                                        <input type="tel" id="bapcontact" name="bapcontact" required maxlength="10" placeholder="XXXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="baptype">Select Schedule Type:<span style="color:red"> *</span></label>
                                                    <select name="baptype" id="baptype" class="form-control">
                                                        <option selected disabled hidden>Select Schedule Type</option>
                                                        <option>Special</option>
                                                        <option>Fixed (Binyagang Bayan)</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="reserveby">Reserve by:<span style="color:red"> *</span></label>
                                                    <input type="text" name="reserveby" id="reserveby" class="form-control" requried />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <select name="verification" id="verification" class="form-control" style="display:none">
                                                        <option>For Document Verification</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <hr style="border-top: 2px solid black;">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="bcert">Attach Live Birth/PSA Birth Certificate:<span style="color:red">*</span></label>
                                                    <input type="file" id="bcert" class="form-control" placeholder="Upload Certificate" name="bcert" accept=".pdf,.jpg,.jpeg,.png" required />
                                                    <div id="previewImageContainer"></div>
                                                </div>
                                             <br>
                                                <div class="col-sm-5">
                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="submit" class="btn btn-lg custom-button">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<form action="baptismalformconnect.php" method="post" enctype="multipart/form-data" id="baptismForm">
    <div class="col-sm-5">
        <div class="d-flex justify-content-end mt-4">

        </div>
    </div>
</form>

<!-- Add this confirmation modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit this baptismal form? Please review your information before confirming.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this script before the closing body tag -->
<!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
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


        <script>
            $(document).ready(function() {
                $("#date_filter").datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '-18y',
                    endDate: '1d',
                    autoclose: true
                })


                jQuery('#dateAndTime').datetimepicker({
                    format: 'Y-m-d g:i A',
                    step: 30,
                    timepicker: true,
                    minDate: new Date()
                });

                $("#dateAndTime, #event_type").on("change", function() {
                    var selectedDateTime = $("#dateAndTime").val();
                    var eventType = $("#event_type").val(); // Get the selected event type

                    $.ajax({
                        url: "php/fetch_available_schedules.php",
                        method: "POST",
                        data: {
                            selectedDateTime: selectedDateTime,
                            eventType: eventType
                        }, // Pass eventType as a parameter
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
            })
        </script>

        <script src="folder/notification.js"></script>
        <script src="folder/my_script.js"></script>
        <script src="folder/jquery.min.js"></script>
        <script src="folder/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="folder/jquery.datetimepicker.full.js"></script>


        <script>
            document.getElementById('number').addEventListener('input', function() {
                if (this.value.length > 11) {
                    this.value = this.value.slice(0, 10); // Limit input to 11 characters
                }
            });
        </script>

        <script>
            document.getElementById('bcert').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file.type.startsWith('image/') && !file.type.startsWith('application/pdf')) {
                    showWarning();
                }
            });
        </script>

    </body>
    </html>