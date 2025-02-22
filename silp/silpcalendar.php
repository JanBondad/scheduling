<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Configuration
include 'dbConnection.php';

// Verify table exists
$checkTable = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($checkTable->num_rows == 0) {
    // Create table if it doesn't exist
    $createTable = "CREATE TABLE IF NOT EXISTS bookings (
        id INT PRIMARY KEY AUTO_INCREMENT,
        church_id INT NOT NULL,
        date DATE NOT NULL,
        time_slot TIME NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (church_id, date, time_slot)
    )";
    
    if (!$conn->query($createTable)) {
        die("Error creating table: " . $conn->error);
    }
}

// Check if service_type column exists
$checkColumn = $conn->query("SHOW COLUMNS FROM bookings LIKE 'service_type'");
if ($checkColumn->num_rows == 0) {
    // Add service_type column if it doesn't exist
    $alterTable = "ALTER TABLE bookings 
                   ADD COLUMN service_type VARCHAR(50) NOT NULL AFTER church_id,
                   ADD COLUMN status VARCHAR(20) DEFAULT 'pending' AFTER time_slot,
                   ADD INDEX (service_type)";
    
    if (!$conn->query($alterTable)) {
        die("Error altering table: " . $conn->error);
    }
}

// ... existing code ...

// Verify table exists
$checkTable = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($checkTable->num_rows == 0) {
    // Create table if it doesn't exist
    $createTable = "CREATE TABLE IF NOT EXISTS bookings (
        id INT PRIMARY KEY AUTO_INCREMENT,
        church_id INT NOT NULL,
        service_type VARCHAR(50) NOT NULL,  // Added this line
        date DATE NOT NULL,
        time_slot TIME NOT NULL,
        status VARCHAR(20) DEFAULT 'pending',  // Added this line
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (church_id, date, time_slot),
        INDEX (service_type)  // Added this index
    )";
    
    if (!$conn->query($createTable)) {
        die("Error creating table: " . $conn->error);
    }
}

// Add the new code here
$checkServiceTimeSlots = $conn->query("SHOW TABLES LIKE 'service_time_slots'");
if ($checkServiceTimeSlots->num_rows == 0) {
    // Create service_time_slots table if it doesn't exist
    $createServiceTimeSlots = "CREATE TABLE IF NOT EXISTS service_time_slots (
        id INT PRIMARY KEY AUTO_INCREMENT,
        service_type VARCHAR(50) NOT NULL,
        time_slot TIME NOT NULL,
        max_slots INT NOT NULL DEFAULT 1,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (service_type, time_slot)
    )";
    
    if (!$conn->query($createServiceTimeSlots)) {
        die("Error creating service_time_slots table: " . $conn->error);
    }

    // Insert default time slots for each service
    $insertTimeSlots = "INSERT INTO service_time_slots (service_type, time_slot, max_slots) VALUES 
        ('Wedding', '10:00:00', 1),
        ('Wedding', '13:30:00', 1),
        ('Wedding', '15:30:00', 1),
        ('Baptismal', '08:00:00', 10),
        ('Baptismal', '11:30:00', 10),
        ('Funeral', '13:00:00', 3),
        ('Funeral', '14:00:00', 3),
        ('Funeral', '15:00:00', 3)";
    
    if (!$conn->query($insertTimeSlots)) {
        die("Error inserting default time slots: " . $conn->error);
    }
}

// Make sure required variables are defined
$firstDayOfMonth = date('Y-m-01'); // First day of current month
// ... rest of your existing code ...

// Make sure required variables are defined
$firstDayOfMonth = date('Y-m-01'); // First day of current month
$lastDayOfMonth = date('Y-m-t');   // Last day of current month
$selectedChurch = isset($_GET['church']) ? (int)$_GET['church'] : 1; // Changed from church_id to church

// Get URL Parameters
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Calculate Date Range
$firstDayOfMonth = date("Y-m-01", strtotime("$year-$month-01"));
$lastDayOfMonth = date("Y-m-t", strtotime("$year-$month-01"));
$selectedDate = date('Y-m-d'); // Today's date as default

// Add these calendar calculations
$daysInMonth = date('t', strtotime("$year-$month-01")); // Number of days in the month
$dayOfWeek = date('w', strtotime($firstDayOfMonth)); // 0 (Sunday) through 6 (Saturday)

// Calculate Navigation Dates
$prevMonth = $month - 1;
$nextMonth = $month + 1;
$prevYear = $year;
$nextYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

// Define Philippine Public Holidays for the selected year
$publicHolidays = [
    "01-01" => "New Year's Day",
    "04-17" => "Maundy Thursday",
    "04-18" => "Good Friday",
    "04-19" => "Black Saturday",
    "05-01" => "Labor Day",
    "06-12" => "Independence Day",
    "08-21" => "Ninoy Aquino Day",
    "11-01" => "All Saints' Day",
    "11-02" => "All Souls' Day",
    "12-25" => "Christmas Day",
    "12-30" => "Rizal Day",
    "12-31" => "New Year's Eve",
    "11-30" => "Bonifacio Day",
    "12-08" => "Immaculate Conception",
    "12-24" => "Christmas Eve",

];

// Fetch available time slots from database based on service type
function getServiceTimeSlots($conn, $service_type) {
    $sql = "SELECT time_slot, max_slots 
            FROM service_time_slots 
            WHERE service_type = ? 
            AND is_active = 1 
            ORDER BY time_slot";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $service_type);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $timeSlots = [];
    while ($row = $result->fetch_assoc()) {
        $timeSlots[$row['time_slot']] = $row['max_slots'];
    }
    
    return $timeSlots;
}

// Check available slots for a specific date and service
function getAvailableSlots($conn, $date, $service_type, $time_slot, $church_id) {
    $sql = "SELECT sts.max_slots - COUNT(b.id) as available_slots
            FROM service_time_slots sts
            LEFT JOIN bookings b ON b.service_type = sts.service_type 
                AND b.time_slot = sts.time_slot 
                AND b.date = ?
                AND b.church_id = ?
                AND b.status != 'cancelled'
            WHERE sts.service_type = ?
                AND sts.time_slot = ?
            GROUP BY sts.time_slot";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $date, $church_id, $service_type, $time_slot);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row ? $row['available_slots'] : 0;
}

// Update the booking creation code
function createBooking($conn, $church_id, $date, $time_slot, $service_type) {
    // First check if slots are available
    $available_slots = getAvailableSlots($conn, $date, $service_type, $time_slot, $church_id);
    
    if ($available_slots <= 0) {
        return [
            'success' => false, 
            'message' => 'No slots available for this time'
        ];
    }
    
    // Begin transaction
    $conn->begin_transaction();
    
    try {
        // Insert the booking
        $sql = "INSERT INTO bookings (church_id, date, time_slot, service_type) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $church_id, $date, $time_slot, $service_type);
        
        if (!$stmt->execute()) {
            throw new Exception("Error creating booking");
        }
        
        // Commit transaction
        $conn->commit();
        
        return [
            'success' => true, 
            'message' => 'Booking created successfully'
        ];
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        return [
            'success' => false, 
            'message' => 'Error: ' . $e->getMessage()
        ];
    }
}

// Update the calendar display to show service-specific availability
function getDateBookings($conn, $date, $service_type) {
    $sql = "SELECT time_slot, COUNT(*) as booking_count
            FROM bookings
            WHERE date = ?
            AND service_type = ?
            AND status != 'cancelled'
            GROUP BY time_slot";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $service_type);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[$row['time_slot']] = $row['booking_count'];
    }
    
    return $bookings;
}

// Remove or comment out this section

$churches = [];
$churchResult = $conn->query("SELECT id, name, location FROM churches");
if ($churchResult) {
    while ($churchRow = $churchResult->fetch_assoc()) {
        $churches[$churchRow['id']] = $churchRow['name'] . " (" . $churchRow['location'] . ")";
    }
}

// Add this after database connection and before displaying the calendar
// Fetch existing bookings for the current month
$firstDayOfMonth = date("Y-m-01", strtotime("$year-$month-01"));
$lastDayOfMonth = date("Y-m-t", strtotime("$year-$month-01"));

$bookingsSql = "SELECT date, COUNT(*) as booking_count 
                FROM bookings 
                WHERE date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'
                AND church_id = $selectedChurch
                GROUP BY date";

$bookingsResult = $conn->query($bookingsSql);
$dateBookings = [];
if ($bookingsResult) {
    while ($row = $bookingsResult->fetch_assoc()) {
        $dateBookings[$row['date']] = $row['booking_count'];
    }
}

// After database connection and before displaying the calendar
// Set maximum total slots per day to 7
$maxTotalSlotsPerDay = 7;

// Initialize the service time slots
$serviceTimeSlots = [
    'Wedding' => [
        '10:00:00' => 1,
        '13:30:00' => 1,
        '15:30:00' => 1
    ],
    'Baptismal' => [
        '08:00:00' => 10,
        '11:30:00' => 10
    ],
    'Funeral' => [
        '13:00:00' => 3,
        '14:00:00' => 3,
        '15:00:00' => 3
    ]
];

// Initialize $timeSlots array
$timeSlots = [];

// Fetch time slots from database
$timeSlotsSql = "SELECT time_slot, max_slots 
                 FROM service_time_slots 
                 WHERE is_active = 1 
                 ORDER BY time_slot";

$timeSlotsResult = $conn->query($timeSlotsSql);

if ($timeSlotsResult && $timeSlotsResult->num_rows > 0) {
    while ($row = $timeSlotsResult->fetch_assoc()) {
        $timeSlots[$row['time_slot']] = [
            'time' => $row['time_slot'],
            'max_slots' => $row['max_slots']
        ];
    }
} else {
    // If no database results, use default time slots
    foreach ($serviceTimeSlots as $service => $slots) {
        foreach ($slots as $time => $maxSlots) {
            $timeSlots[$time] = [
                'time' => $time,
                'max_slots' => $maxSlots
            ];
        }
    }
}

// Calculate slots per time slot (line 211)
$slotsPerTimeSlot = count($timeSlots) > 0 ? floor($maxTotalSlotsPerDay / count($timeSlots)) : 0;

// Update the time slots in the database
$updateSlotsSql = "UPDATE booking_time_slots SET max_slots = $slotsPerTimeSlot WHERE is_active = 1";
$conn->query($updateSlotsSql);

// When fetching time slots, make sure they use the new max_slots value
$timeSlotsSql = "SELECT id, time_slot, max_slots 
                 FROM booking_time_slots 
                 WHERE is_active = 1 
                 ORDER BY time_slot";

$timeSlotsResult = $conn->query($timeSlotsSql);

if ($timeSlotsResult && $timeSlotsResult->num_rows > 0) {
    while ($row = $timeSlotsResult->fetch_assoc()) {
        $timeKey = $row['time_slot'];
        $timeSlots[$timeKey] = [
            'time' => $row['time_slot'],
            'max_slots' => $slotsPerTimeSlot  // Use the calculated value
        ];
    }
} else {
    // If no database results, use default time slots
    for ($hour = 9; $hour <= 17; $hour++) {
        $timeKey = sprintf("%02d:00:00", $hour);
        $timeSlots[$timeKey] = [
            'time' => $timeKey,
            'max_slots' => $slotsPerTimeSlot  // Use the calculated value
        ];
    }
}

// Set the total slots per day to exactly 15
$totalSlotsPerDay = $maxTotalSlotsPerDay;

// Define Available Time Slots with max slots per time
$timeSlots = [];
$maxSlotsPerTime = 3; // Maximum number of bookings allowed per time slot

// Define specific time slots
$specificTimes = ['09:00', '11:00', '13:00', '15:00', '17:00'];

foreach ($specificTimes as $time) {
    $timeSlots[$time] = $maxSlotsPerTime;
}

// Define unavailable date range for bookings (7 days from today)
$unavailableUntilDate = date("Y-m-d", strtotime("+7 days"));

// ... existing code ...

// Update the service time slots with more specific times
$serviceTimeSlots = [
    'Wedding' => [
        '08:00:00' => 1,
        '10:00:00' => 1,
        '13:30:00' => 1,
        '15:30:00' => 1
    ],
    'Baptismal' => [
        '08:00:00' => 10,
        '10:00:00' => 10,
        '11:30:00' => 10,
        '14:00:00' => 10
    ],
    'Funeral' => [
        '09:00:00' => 3,
        '11:00:00' => 3,
        '13:00:00' => 3,
        '14:00:00' => 3,
        '15:00:00' => 3,
        '16:00:00' => 3
    ]
];

// ... existing code ...

function getDateAvailability($conn, $date, $church_id) {
    $sql = "SELECT 
        sts.service_type,
        sts.time_slot,
        sts.max_slots,
        COUNT(b.id) as booked_slots,
        sts.max_slots - COUNT(b.id) as available_slots 
        FROM service_time_slots sts
        LEFT JOIN bookings b ON b.service_type = sts.service_type 
            AND b.time_slot = sts.time_slot 
            AND b.date = ? 
            AND b.church_id = ? 
            AND b.status != 'cancelled'
        GROUP BY sts.service_type, sts.time_slot";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("si", $date, $church_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $availability = [];
    while ($row = $result->fetch_assoc()) {
        $availability[$row['service_type']][$row['time_slot']] = [
            'max' => $row['max_slots'],
            'booked' => $row['booked_slots'],
            'available' => $row['available_slots']
        ];
    }

    return $availability;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="ig.jpg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Ignatius of Loyola Parish (Ususan, Taguig)</title>
    <link rel="stylesheet" type="text/css" href="silpcalendar.css">
    <style>
        /* CSS to mark 7-day unavailable dates as gray */
        .unavailable {
            background-color: lightgray;
            color: darkgray;
            pointer-events: none;
        }
        .booked {
            background-color: lightcoral;
            color: darkred;
            pointer-events: none;
        }
        .available {
            background-color: lightgreen;
            color: darkgreen;
        }
        .closed {
            background-color: lightblue;
            color: darkblue;
            pointer-events: none;
        }
        .time-slot {
            display: block;
            padding: 5px;
            margin: 2px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .time-slot.available {
            background-color: #d4edda;
        }
        .time-slot.booked {
            background-color: #f8d7da;
        }
        .slot-info {
            font-size: 0.8em;
            color: #555;
        }
        .calendar-navigation {
            margin: 20px 0;
            text-align: center;
        }

        .calendar-navigation select {
            padding: 8px;
            margin: 0 5px;
            font-size: 16px;
        }

        .calendar-navigation button {
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
        }

        .nav-link {
            text-decoration: none;
            padding: 8px 15px;
            background-color: #f0f0f0;
            border-radius: 4px;
            color: #333;
        }

        .nav-link:hover {
            background-color: #e0e0e0;
        }

        .date-selector {
            text-align: center;
        }

        .month-year-form {
            display: inline-flex;
            gap: 10px;
        }

        .month-year-form select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
            background-color: white;
        }

        .calendar-header span {
            font-size: 1.2em;
            font-weight: bold;
        }

        .time-slot button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .time-slot button:hover {
            background-color: #f0f0f0;
        }

        .slot-info {
            display: block;
            font-size: 0.8em;
            color: #666;
        }

        /* Unavailable dates styling */
        .calendar-day.unavailable {
            background-color: #f0f0f0;  /* light gray */
            color: #999;  /* darker gray for text */
            cursor: not-allowed;
            pointer-events: none;
        }

    /* Past dates styling */
    .calendar-day.past {
        background-color: #f0f0f0;
        color: #999;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Unavailable dates styling (within 7 days) */
    .calendar-day.unavailable {
        background-color: #ffe6cc;  /* light orange */
        color: #cc7a00;  /* darker orange */
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Holiday styling */
    .calendar-day.holiday {
        background-color: #ffe6e6;  /* light red */
        color: #cc0000;  /* darker red */
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Closed (Sunday) styling */
    .calendar-day.closed {
        background-color: #e6e6ff;  /* light blue */
        color: #0000cc;  /* darker blue */
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Booked styling */
    .calendar-day.booked {
        background-color: #ffcccc;  /* light red */
        color: #cc0000;  /* darker red */
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Available styling */
    .calendar-day.available {
        background-color: #e6ffe6;  /* light green */
        color: #006600;  /* darker green */
        cursor: pointer;
    }

    .calendar-day.available:hover {
        background-color: #ccffcc;  /* lighter green on hover */
    }

    .calendar-day .slots {
    font-size: 0.75em;
    display: block;
    margin-top: 2px;
    text-align: center;
    line-height: 1.2;
}

.calendar-day.available .slots {
    color: #006600;
}

.calendar-day.available.sunday .slots {
    color: #004d00;
    font-weight: bold;
}

    button.disabled {
    background-color: #cccccc !important;
    color: #666666 !important;
    cursor: not-allowed !important;
    opacity: 0.7;
    pointer-events: none !important; /* This will completely prevent clicking */
    }

    button.disabled:hover {
    background-color: #cccccc !important;
    }

    .time-slot {
        margin: 10px 0;
        padding: 5px;
        border-radius: 5px;
    }

    .time-slot button {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .time-slot.available button {
        background-color: #d4edda;
        color: #155724;
    }

    .time-slot.available button:hover {
        background-color: #c3e6cb;
    }

    .time-slot.booked button {
        background-color: #f8d7da;
        color: #721c24;
        cursor: not-allowed;
    }

    .slot-info {
        font-size: 14px;
        color: inherit;
        opacity: 0.8;
    }

    .modal-content {
        max-width: 500px;
        width: 90%;
        padding: 20px;
        border-radius: 10px;
    }

    .modal-content h2 {
        margin-bottom: 20px;
        color: #333;
    }


</style>

    </style>
</head>
<body>
<body>
    <a href="../index.php" class="back-button">← Back to Home</a>
    <!-- Rest of your existing code -->

            
    <!-- Main Calendar Container -->
    <div id="calendar">
    <h1>Welcome to St. Ignatius of Loyola Parish</h1>
        <!-- Church Selection Form -->
        <!-- <form action="calend.php" method="GET">
            <label for="church">Select Church:</label>
            <select name="church" id="church" onchange="this.form.submit()">
                <option value="1" <?php echo ($selectedChurch == 1) ? 'selected' : ''; ?>>St. Ignatius of Loyola Parish (Ususan, Taguig)</option>
                <option value="2" <?php echo ($selectedChurch == 2) ? 'selected' : ''; ?>>St. Michael the Archangel Parish (BGC, Taguig)</option>
                <option value="3" <?php echo ($selectedChurch == 3) ? 'selected' : ''; ?>>Sto. Rosario de Pasig Parish (Rosario, Pasig)</option>
                <option value="4" <?php echo ($selectedChurch == 4) ? 'selected' : ''; ?>>Sta. Rosa de Lima Parish (Bagong Ilog, Pasig)</option>
            </select>
        </form> -->

        <!-- Month Navigation -->
        <div class="calendar-header">
    <div class="date-navigation">
        <a href="silpcalendar.php?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>&church=<?php echo $selectedChurch; ?>" class="nav-link">Previous</a>
</div>



            <div class="date-selector">
                <form action="silpcalendar.php" method="GET" class="month-year-form">
                    <select name="month" onchange="this.form.submit()">
                        <?php
                        $months = [
                            1 => 'January', 2 => 'February', 3 => 'March',
                            4 => 'April', 5 => 'May', 6 => 'June',
                            7 => 'July', 8 => 'August', 9 => 'September',
                            10 => 'October', 11 => 'November', 12 => 'December'
                        ];
                        foreach ($months as $num => $name) {
                            $selected = ($num == $month) ? 'selected' : '';
                            echo "<option value=\"$num\" $selected>$name</option>";
                        }
                        ?>
                    </select>
                    <select name="year" onchange="this.form.submit()">
                        <?php
                        $currentYear = date('Y');
                        $maxYear = $currentYear + 5; // Show 5 years into the future
                        for ($y = $currentYear; $y <= $maxYear; $y++) {
                            $selected = ($y == $year) ? 'selected' : '';
                            echo "<option value=\"$y\" $selected>$y</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="church" value="<?php echo $selectedChurch; ?>">
                </form>
            </div>

            <a href="silpcalendar.php?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>&church=<?php echo $selectedChurch; ?>" class="nav-link">Next</a>
        </div>

                        
        <!-- Calendar Grid -->
        <div class="calendar-grid">
            <?php
            // Display Days of Week Headers
            $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            foreach ($daysOfWeek as $day) {
                echo "<div class='calendar-day-header'>$day</div>";
            }

            // Display Empty Cells for Offset
            for ($i = 0; $i < $dayOfWeek; $i++) {
                echo "<div class='calendar-day empty'></div>";
            }

// ... existing code ...

// ... existing code ...

// ... existing code ...

// Display Calendar Days
for ($day = 1; $day <= $daysInMonth; $day++) {
    $currentDate = date("Y-m-d", strtotime("$year-$month-$day"));
    $displayDate = date("F j, Y", strtotime($currentDate));
    $dayOfWeekNum = date("w", strtotime($currentDate));
    
    // Calculate if date is unavailable
    $isPastDate = strtotime($currentDate) < strtotime(date('Y-m-d')); // Before today
    $isWithin7Days = strtotime($currentDate) < strtotime('+7 days'); // Within next 7 days
    $isSunday = ($dayOfWeekNum == 0); // Check if it's Sunday
    $isMonday = ($dayOfWeekNum == 1); // Check if it's Monday
    $isHoliday = isset($publicHolidays[date("m-d", strtotime($currentDate))]);
    
    // Get availability for the date
    $dateAvailability = getDateAvailability($conn, $currentDate, $selectedChurch);
    $totalAvailable = 0;
    
    foreach ($dateAvailability as $service => $slots) {
        // For Sundays, only count Baptismal and Funeral slots
        if ($isSunday && $service !== 'Wedding') {
            foreach ($slots as $slot) {
                $totalAvailable += $slot['available'];
            }
        } elseif (!$isSunday) {
            // For other days, count all slots
            foreach ($slots as $slot) {
                $totalAvailable += $slot['available'];
            }
        }
    }

    // Determine the appropriate class
    if ($isPastDate) {
        $dayClass = "past";
        $statusMessage = "Past Date";
    } elseif ($isWithin7Days) {
        $dayClass = "unavailable";
        $statusMessage = "Book 7 days ahead";
    } elseif ($isHoliday) {
        $dayClass = "holiday";
        $statusMessage = $publicHolidays[date("m-d", strtotime($currentDate))];
    } elseif ($isMonday) {
        $dayClass = "closed";
        $statusMessage = "Closed";
    } elseif ($isSunday) {
        if ($totalAvailable > 0) {
            $dayClass = "available sunday";
            $statusMessage = "Available<br>(Baptism/Funeral Only)";
        } else {
            $dayClass = "booked";
            $statusMessage = "Fully Booked";
        }
    } elseif ($totalAvailable <= 0) {
        $dayClass = "booked";
        $statusMessage = "Fully Booked";
    } else {
        $dayClass = "available";
        $statusMessage = "Available<br>($totalAvailable slots)";
    }

    // Output the calendar day cell
    echo "<div class='calendar-day $dayClass' onclick=\"showServiceModal('$currentDate', '$displayDate')\">";
    echo "<span class='day-number'>$day</span>";
    echo "<span class='slots'>$statusMessage</span>";
    echo "</div>";
}

// Fill in remaining calendar grid cells if needed
$endingDay = ($dayOfWeek + $daysInMonth) % 7;
if ($endingDay > 0) {
    $remainingDays = 7 - $endingDay;
    for ($i = 0; $i < $remainingDays; $i++) {
        echo "<div class='calendar-day empty'></div>";
    }
}

            ?>
        </div>
    </div>


<!-- Service Selection Modal -->
<div id="serviceModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('serviceModal')">&times;</span>
        <h1>Select Service for <span id="selectedDate"></span></h1>
        <button onclick="selectService('Wedding')" title="">Wedding</button>
        <button onclick="selectService('Funeral')">Funeral</button>
        <button onclick="selectService('Confirmation')" title="">Confirmation</button>
        <button onclick="selectService('Baptismal')">Baptismal</button>
    </div>
</div>

    <!-- Confirmation Popup -->
    <div id="confirmationPopup" class="popup" style="display: none;">
        <p>Sorry! This service is not available. It only opens in December. Thank you!</p>
        <button onclick="closeConfirmationPopup()">Close</button>
    </div>

    <!-- Time Slot Selection Modal -->
    <div id="timeModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('timeModal')">&times;</span>
            <h2>Select Time Slot for <span id="selectedService"></span> on <span id="serviceDate"></span></h2>
            <div id="timeSlotContainer">
                <!-- Time slots will be populated here -->
            </div>
        </div>
    </div>

    <script>
        // Declare these at the top of your script section
        let selectedDate = null;
        let selectedService = null;

        function showServiceModal(date, displayDate) {
    selectedDate = date;
    const selectedDateObj = new Date(date);
    const isSunday = selectedDateObj.getDay() === 0;
    
    document.getElementById('selectedDate').innerText = displayDate;
    
    // Update the buttons based on the day
    const weddingButton = document.querySelector('button[onclick="selectService(\'Wedding\')"]');
    const confirmationButton = document.querySelector('button[onclick="selectService(\'Confirmation\')"]');
    
    if (isSunday) {
        // Disable and style the buttons for Sunday
        weddingButton.disabled = true;
        weddingButton.classList.add('disabled');
        weddingButton.title = 'Wedding services are not available on Sundays';
        
        confirmationButton.disabled = true;
        confirmationButton.classList.add('disabled');
        confirmationButton.title = 'Confirmation services are not available on Sundays';
    } else {
        // Enable and remove disabled styling for non-Sundays
        weddingButton.disabled = false;
        weddingButton.classList.remove('disabled');
        weddingButton.title = '';
        
        confirmationButton.disabled = false;
        confirmationButton.classList.remove('disabled');
        confirmationButton.title = '';
    }
    
    document.getElementById('serviceModal').style.display = 'block';
}

        function showServiceModal(date, displayDate) {
            selectedDate = date;  // Keep the database format for backend
            document.getElementById('selectedDate').innerText = displayDate;  // Show formatted date
            document.getElementById('serviceModal').style.display = 'block';
        }

        function selectService(service) {
    const selectedDateObj = new Date(selectedDate);
    const isSunday = selectedDateObj.getDay() === 0;
    
    // Prevent Wedding and Confirmation services on Sundays
    if (isSunday && (service === 'Wedding' || service === 'Confirmation')) {
        alert('This service is not available on Sundays. Please select another date or service.');
        return; // Exit the function early
    }

    selectedService = service;
    
    if (service === 'Confirmation') {
        document.getElementById('confirmationPopup').style.display = 'block';
        closeModal('serviceModal');
    } else {
        document.getElementById('selectedService').innerText = service;
        document.getElementById('serviceDate').innerText = document.getElementById('selectedDate').innerText;
        closeModal('serviceModal');
        document.getElementById('timeModal').style.display = 'block';
        populateTimeSlots(service);
    }
}

function populateTimeSlots(service) {
    var container = document.getElementById('timeSlotContainer');
    container.innerHTML = '<p>Loading available time slots...</p>';
    
    fetch(`get_time_slots.php?service=${encodeURIComponent(service)}&date=${encodeURIComponent(selectedDate)}&church=<?php echo $selectedChurch; ?>`)
        .then(response => response.json())
        .then(timeSlots => {
            container.innerHTML = '';
            
            if (!timeSlots || Object.keys(timeSlots).length === 0) {
                container.innerHTML = '<p>No time slots available for this service.</p>';
                return;
            }
            
            Object.entries(timeSlots).forEach(([time, data]) => {
                const [hours, minutes] = time.split(':');
                const timeDisplay = new Date(2000, 0, 1, hours, minutes)
                    .toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                
                const slotDiv = document.createElement('div');
                slotDiv.className = `time-slot ${data.available_slots > 0 ? 'available' : 'booked'}`;
                
                slotDiv.innerHTML = `
                    <button 
                        onclick="redirectToForm('${time}', '${timeDisplay}')"
                        ${data.available_slots <= 0 ? 'disabled' : ''}>
                        ${timeDisplay}
                        <span class="slot-info">
                            (${data.available_slots} of ${data.max_slots} slots available)
                        </span>
                    </button>`;
                
                container.appendChild(slotDiv);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = '<p>Error loading time slots. Please try again.</p>';
        });
}
            
            xhr.send();

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function closeConfirmationPopup() {
            document.getElementById('confirmationPopup').style.display = 'none';
        }

        function redirectToForm(timeSlot, timeDisplay) {
            console.group('Debugging Redirect');
            console.log('Selected Date:', selectedDate);
            console.log('Selected Service:', selectedService);
            console.log('Time Slot:', timeSlot);
            console.log('Time Display:', timeDisplay);
            
            let formLink;
            switch (selectedService) {
                case 'Baptismal':
                    formLink = 'Baptismsilp.php';
                    break;
                case 'Wedding':
                    formLink = 'Marriagesilp.php';
                    break;
                case 'Funeral':
                    formLink = 'Burialsilp.php';
                    break;
                default:
                    console.error('Invalid service:', selectedService);
                    console.groupEnd();
                    alert("Unknown service selected!");
                    return;
            }

            const churchId = <?php echo $selectedChurch; ?>;
            // Ensure all parameters are properly encoded
            const url = `${formLink}?` + new URLSearchParams({
                church: churchId,
                date: selectedDate,
                time: timeSlot,
                service: selectedService,
                displayTime: timeDisplay
            }).toString();
            
            console.log('Final URL:', url);
            console.groupEnd();
            
            window.location.href = url;
        }
        function checkAvailability(date, service, timeSlot) {
            return fetch(`check_availability.php?date=${date}&service=${service}&time=${timeSlot}`)
                .then(response => response.json())
                .then(data => {
                    return data.available_slots;
                });
        }
    </script>
</body>
</html>
<?php
// Close the connection only after everything is done
$conn->close();
?>
