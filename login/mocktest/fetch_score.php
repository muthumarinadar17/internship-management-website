<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "login");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

$email = $_GET['email'] ?? null;
$test_name = $_GET['test_name'] ?? null;
$data_type = $_GET['data_type'] ?? null;  // Fetch data_type from request

if (!$email || !$test_name || !$data_type) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit();
}

$sql = "SELECT score, total_questions FROM quiz_scores WHERE email = ? AND test_name = ? AND data_type = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "SQL Error: " . $conn->error]);
    exit();
}

$stmt->bind_param("sss", $email, $test_name, $data_type);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "score" => $row["score"], "total_questions" => $row["total_questions"]]);
} else {
    echo json_encode(["success" => false, "message" => "No score found"]);
}

$stmt->close();
$conn->close();
?>
