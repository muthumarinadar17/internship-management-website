<?php
header("Content-Type: application/json"); // Ensures JSON response
session_start();
include 'connect.php';


$data = json_decode(file_get_contents("php://input"), true) ?? [];

// Handle POST request to add internship
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["name"]) || !isset($data["company"]) || !isset($data["location"]) || !isset($data["duration"]) 
    || !isset($data["internshipDescription"]) || !isset($data["stipend"]) || !isset($data["applyBy"]) || !isset($data["skills"]) 
    || !isset($data["internshipduration"]) || !isset($data["companyName"]) || !isset($data["companyDescription"]) || !isset($data["perks"])){
        echo json_encode(["success" => false, "message" => "Missing required fields"]);
        exit;
    }

    $name = $conn->real_escape_string($data["name"]);
    $company = $conn->real_escape_string($data["company"]);
    $location = $conn->real_escape_string($data["location"]);
    $duration = $conn->real_escape_string($data["duration"]);
    $internshipDescription = $conn->real_escape_string($data["internshipDescription"]);
    $stipend = $conn->real_escape_string($data["stipend"]);
    $applyBy = $conn->real_escape_string($data["applyBy"]);
    $skills = $conn->real_escape_string($data["skills"]);
    $internshipduration = $conn->real_escape_string($data["internshipduration"]);
    $companyName = $conn->real_escape_string($data["companyName"]);
    $companyDescription = $conn->real_escape_string($data["companyDescription"]);
    $perks = $conn->real_escape_string($data["perks"]);


    $sql = "INSERT INTO internships (name, company, location, duration, internshipDescription, stipend, applyBy, skills, internshipduration, 
            companyName, companyDescription, perks) VALUES ('$name', '$company', '$location', '$duration', '$internshipDescription', '$stipend',
            '$applyBy', '$skills', '$internshipduration', '$companyName', '$companyDescription', '$perks')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Internship added!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
    exit;
}

// Handle GET request to fetch internships
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM internships ORDER BY id DESC";
    $result = $conn->query($sql);

    $internships = [];
    while ($row = $result->fetch_assoc()) {
        $internships[] = $row;
    }

    echo json_encode($internships);
    exit;
}

$conn->close();
?>
