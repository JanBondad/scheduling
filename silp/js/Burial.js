
function capitalizeFirstLetter(input) {
    let value = input.value;
    input.value = value.charAt(0).toUpperCase() + value.slice(1);
}

$(document).ready(function () {
    $("#date_filter").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3m',
        endDate: '-0d',
        autoclose: true
    });

    $('#dateAndTime').datetimepicker({
        format: 'Y-m-d g:i A', // Correct format for date and time
        step: 30, // Time step of 30 minutes
        timepicker: true, // Enable the time picker
        minDate: new Date() // Prevent past dates
    });
});



document.getElementById('bcontact').addEventListener('input', function () {
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 10);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Date of Death || Disable future dates
    const bdatedeath = document.getElementById("bdatedeath");

    if (bdatedeath) {
        const today = new Date().toISOString().split("T")[0];
        bdatedeath.max = today;
    }

    // Date of Burial || Disable past dates
    const bapdatetime_display = document.getElementById("bapdatetime_display");
    if (bapdatetime_display) {
        let today = new Date().toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:MM
        document.getElementById("bapdatetime_display").min = today;
    }
});



// Function to save form data into session storage
function saveFormData() {
    var formData = {};
    // Get all input elements in the form
    var inputs = document.querySelectorAll('input[name], select[name]');
    inputs.forEach(function (input) {
        formData[input.name] = input.value;
    });
    // Save form data into session storage
    sessionStorage.setItem('funeral_form_data', JSON.stringify(formData));
}

// Function to retrieve saved form data and fill the form
window.onload = function () {
    var savedData = sessionStorage.getItem('funeral_form_data');
    if (savedData) {
        var formData = JSON.parse(savedData);
        // Fill the form with saved data
        var inputs = document.querySelectorAll('input[name], select[name]');
        inputs.forEach(function (input) {
            if (formData.hasOwnProperty(input.name)) {
                input.value = formData[input.name];
            }
        });
    }
};


document.getElementById('bdeathcert').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file.type.startsWith('image/') && !file.type.startsWith('application/pdf')) {
        showWarning();
    }
});


function submitForm(event) {
    event.preventDefault();

    // Create FormData object
    const formData = new FormData(document.getElementById('burialForm'));

    console.log('Submitting form data:', formData);
    // Send form data using fetch
    fetch('burialformconnect.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            // Redirect to success.php after successful submission
            window.location.href = 'success.php';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the form.');
        });
}
