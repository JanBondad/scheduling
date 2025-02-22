<?php
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
    <title>SILP Burial Form</title>
    <link rel="stylesheet" href="folder/bootstrap.min.css">
    <link href="folder/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="folder/jquery.datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="css/Burialslip.css">
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

    <!-- Load this script after jQuery scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>
</head>

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
        <div class="dashboard-container">
            <div class="main-content">
                <div class="top-bar">
                    <div class="profile">
                        <span>SILP FUNERAL FORM</span>
                    </div>
                </div>

                <div class="container py-5" id="page-container">


                    <div class="container py-5" id="page-container">
                        <div class="col-sm-12">
                            <div class="form-box">
                                <div class="form-title">SILP BURIAL FORM <img src="ig.jpg" alt="Diocesan Logo" width="100" height="100" style="float: right;"> </div>
                                <a href="silpcalendar.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                                <form action="burialformconnect.php" method="post" id="burialForm" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div>
                                                <!-- Deceased Information -->
                                                <div class="row">
                                                    <h4><b>Deceased Information:</b></h4>
                                                    <div class="col-sm-6">
                                                        <label for="bname">Full Name:<span style="color:red"> *</span></label>
                                                        <input type="text" id="bname" name="bname" class="form-control" required placeholder="Full Name" oninput="capitalizeFirstLetter(this)" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="bage">Age:<span style="color:red"> *</span></label>
                                                        <input type="text" id="bage" name="bage" class="form-control" required placeholder="Age" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);" />
                                                    </div>


                                                </div> <br>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="bdatedeath">Date of Death:<span style="color:red"> *</span></label>
                                                        <input type="date" id="bdatedeath" name="bdatedeath" class="form-control" required placeholder="mm/dd/yy" />
                                                    </div>

                                                    <div class="row">
                                                        <h4><b>Schedule Information:</b></h4>
                                                        <div class="col-sm-3">
                                                            <label for="bapdatetime_display">Date & Time:<span style="color:red"> *</span></label>
                                                            <input type="text" name="bapdatetime_display" id="bapdatetime_display" required placeholder="Date & Time" class="form-control" disabled
                                                                value="<?php echo htmlspecialchars($selectedDateTime); ?>" aria-label="Selected Date and Time">
                                                            <input type="hidden" name="bdatetime" id="bdatetime" value="<?php echo htmlspecialchars($selectedDateTime); ?>" class="form-control">
                                                        </div>
                                                        <br><br>

                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="col-sm-12">
                                                                    <label for="bparish">Parish:<span style="color:red"> *</span></label><br>
                                                                    <select id="bparish" name="bparish" class="form-control" aria-label="Place of Burial">
                                                                        <optgroup label="Choose your preferred Parish:">
                                                                            <option value="St. Ignatius of Loyola Parish" <?php if ($selectedChurch == "St. Ignatius of Loyola Parish") echo "selected"; ?>>St. Ignatius of Loyola Parish</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>


                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <label for="blfuneral">Location of Funeral:<span style='color:red'> *</span></label>
                                                                        <select name="blfuneral" id="blfuneral" required class="form-control">
                                                                            <option value="" selected disabled>Select Location</option>
                                                                            <optgroup label="Pasig City">
                                                                                <option value="Pasig Catholic Cemetery">Pasig Catholic Cemetery</option>
                                                                                <option value="Pasig City Public Cemetery">Pasig City Public Cemetery</option>
                                                                                <option value="San Juan Municipal Cemetery">San Juan Municipal Cemetery</option>
                                                                                <option value="Santo Tomas de Villanueva Parish">Santo Tomas de Villanueva Parish</option>
                                                                                <option value="Santa Clara de Montefalco Parish Ossuary">Santa Clara de Montefalco Parish Ossuary</option>
                                                                            </optgroup>
                                                                            <optgroup label="Pateros">
                                                                                <option value="Garden of Memories Memorial Park">Garden of Memories Memorial Park</option>
                                                                                <option value="San Roque Catholic Cemetery">San Roque Catholic Cemetery</option>
                                                                                <option value="Sta. Marta Catholic Cemetery">Sta. Marta Catholic Cemetery</option>
                                                                                <option value="Municipality of Pateros Public Cemetery">Municipality of Pateros Public Cemetery</option>
                                                                            </optgroup>
                                                                            <optgroup label="Taguig City">
                                                                                <option value="Taguig Catholic Cemetery">Taguig Catholic Cemetery</option>
                                                                                <option value="Hagonoy Catholic Cemetery">Hagonoy Catholic Cemetery</option>
                                                                                <option value="Libingan ng mga Bayani">Libingan ng mga Bayani</option>
                                                                                <option value="Heritage Memorial Park">Heritage Memorial Park</option>
                                                                                <option value="Tipas Catholic Cemetery">Tipas Catholic Cemetery</option>
                                                                                <option value="Taguig City Public Cemetery">Taguig City Public Cemetery</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <hr style="border-top: 2px solid black;">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <!-- Reserver Requirements -->
                                                                        <h4><b>Reserver Requirements:</b></h4>
                                                                        <div class="col-sm-6">
                                                                            <label for="breserve">Full Name:<span style="color:red"> *</span></label>
                                                                            <input type="text" id="breserve" name="breserve" required placeholder="Full name of the Reserver" class="form-control" oninput="capitalizeFirstLetter(this)" />
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label for="bemail">Email Address:<span style="color:red"> *</span></label>
                                                                            <input type="text" id="bemail" name="bemail" required placeholder="Email address of the Reserver" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>

                                                                <!-- Other input fields for reserver requirements -->
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-3">
                                                                            <label for="bcontact" class="form-label">Contact Number:<span style="color:red"> *</span></label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text">+63</span>
                                                                                <input type="tel" id="bcontact" name="bcontact" required maxlength="10" placeholder="XXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                            <label for="bdeathcert" class="form-label" style="color: black;">Attached Death Certificate:<span style="color:red"> (Required)<span style="color:red"> *</span></label><br>
                                                                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" class="form-control" name="bdeathcert" id="bdeathcert" required />
                                                                        </div>

                                                                    </div>
                                                                    <br>
                                                                    <hr style="border-top: 1px solid black;">
                                                                    <div class="d-flex justify-content-end mt-4">
                                                                        <button type="submit" class="btn btn-lg custom-button">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </form>


        </div>
    </div>

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
</body>
<script src="./js/Burial.js"></script>

</html>