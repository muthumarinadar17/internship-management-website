<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "login");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid JSON input"]);
    exit();
}

$email = $data['email'] ?? null;
$test_name = $data['test_name'] ?? null;
$data_type = $data['data_type'] ?? null;
$score = $data['score'] ?? null;
$total_questions = $data['total_questions'] ?? null;

if (!$email || !$test_name || !$score || !$total_questions) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit();
}

$sql = "INSERT INTO quiz_scores (email, test_name, data_type, score, total_questions) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "SQL Error: " . $conn->error]);
    exit();
}

$stmt->bind_param("sssii", $email, $test_name, $data_type, $score, $total_questions);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Insert failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
