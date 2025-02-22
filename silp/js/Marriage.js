
function capitalizeFirstLetter(input) {
    let value = input.value;
    input.value = value.charAt(0).toUpperCase() + value.slice(1);
}

function selectSameCivilStatus(selectElement) {
    var selectedValue = selectElement.value;
    var otherSelect = document.getElementById("mwstatus");

    // Find the option with the same value in the other select element
    var optionToSelect = Array.from(otherSelect.options).find(option => option.value === selectedValue);

    if (optionToSelect) {
        otherSelect.value = optionToSelect.value;
    }
}

$(document).ready(function () {
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

    $("#dateAndTime, #event_type").on("change", function () {
        var selectedDateTime = $("#dateAndTime").val();
        var eventType = $("#event_type").val();

        $.ajax({
            url: "php/fetch_available_schedules_wedding.php",
            method: "POST",
            data: {
                selectedDateTime: selectedDateTime,
                eventType: eventType
            },
            success: function (data) {
                $("#availableSchedules").html("Available Schedules: " + data);
                var availableCount = parseInt(data);
                toggleSubmitButton(availableCount > 0);
            },
            error: function () {
                $("#availableSchedules").html("Error fetching available schedules.");
                toggleSubmitButton(false);
            }
        });
    });

    // const sections = document.querySelectorAll('.form-section');
    // let currentSection = 0;
    // const nextButton = document.getElementById('nextSection');

    // function showSection(sectionIndex) {
    //     sections.forEach((section, index) => {
    //         if (index === sectionIndex) {
    //             section.style.display = 'block';
    //         } else {
    //             section.style.display = 'none';
    //         }
    //     });

    //     if (sectionIndex === sections.length - 1) {
    //         nextButton.disabled = true;
    //     } else {
    //         nextButton.disabled = false;
    //     }
    // }

    // document.getElementById('nextSection').addEventListener('click', () => {
    //     if (currentSection < sections.length - 1) {
    //         currentSection++;
    //         showSection(currentSection);
    //     }
    // });

    // document.getElementById('prevSection').addEventListener('click', () => {
    //     if (currentSection > 0) {
    //         currentSection--;
    //         showSection(currentSection);
    //     }
    // });

    // showSection(currentSection);

    // Disable future dates
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('mhbirth').setAttribute('max', today);
    document.getElementById('mwbirth').setAttribute('max', today);
});


document.getElementById('mnumber').addEventListener('input', function () {
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 10); // Limit input to 11 characters
    }
});



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



// Add file type validation to all file inputs
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function (e) {
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
document.addEventListener('DOMContentLoaded', function () {
    // Close button event listener
    document.querySelector('.close-btn').addEventListener('click', hideWarning);

    // OK button event listener
    document.querySelector('.okay-btn').addEventListener('click', hideWarning);

    // Close on overlay click (optional)
    document.querySelector('.popup-overlay').addEventListener('click', function (e) {
        if (e.target === this) {
            hideWarning();
        }
    });
});
