<?php
require_once 'dbConnection.php'; // Ensure this file correctly establishes the DB connection

header('Content-Type: application/json');

$date = $_GET['date'] ?? null;
$service = $_GET['service'] ?? null;

if (!$date || !$service) {
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

$timeSlots = [];

if ($service === "Funeral") {
    // Ensure the time format is HH:MM:SS (without microseconds)
    $stmt = $conn->prepare("SELECT DATE_FORMAT(funeral_date, '%H:%i:%s') as funeral_time, COUNT(*) as count FROM burial WHERE DATE(funeral_date) = ? GROUP BY funeral_time");

    if ($stmt) {
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $timeSlots[$row['funeral_time']] = (int) $row['count'];
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Query preparation failed']);
        exit;
    }
} else if ($service === "Wedding") {
    // Ensure the time format is HH:MM:SS (without microseconds)
    $stmt = $conn->prepare("SELECT DATE_FORMAT(date_time, '%H:%i:%s') as date_time, COUNT(*) as count FROM matrimony WHERE DATE(date_time) = ? GROUP BY date_time");

    if ($stmt) {
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $timeSlots[$row['date_time']] = (int) $row['count'];
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Query preparation failed']);
        exit;
    }
} else if ($service === "Baptismal") {
    // Ensure the time format is HH:MM:SS (without microseconds)
    $stmt = $conn->prepare("SELECT DATE_FORMAT(date_time, '%H:%i:%s') as date_time, COUNT(*) as count FROM baptism WHERE DATE(date_time) = ? GROUP BY date_time");

    if ($stmt) {
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $timeSlots[$row['date_time']] = (int) $row['count'];
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Query preparation failed']);
        exit;
    }
}

// Return JSON object with properly formatted keys
echo json_encode($timeSlots);
?>