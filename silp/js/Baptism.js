$(document).ready(function () {
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

    $("#dateAndTime, #event_type").on("change", function () {
        var selectedDateTime = $("#dateAndTime").val();
        var eventType = $("#event_type").val(); // Get the selected event type

        $.ajax({
            url: "php/fetch_available_schedules.php",
            method: "POST",
            data: {
                selectedDateTime: selectedDateTime,
                eventType: eventType
            }, // Pass eventType as a parameter
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

    // Disable future dates
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('bapdbirth').setAttribute('max', today);

    document.getElementById('bapcontact').addEventListener('input', function () {
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 10); // Limit input to 11 characters
        }
    });



    document.getElementById('bcert').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file.type.startsWith('image/') && !file.type.startsWith('application/pdf')) {
            showWarning();
        }
    });
})