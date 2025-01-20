<?php
header('Content-Type: application/json'); // Set Content-Type header
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection function
function getDatabaseConnection()
{
  $conn = new mysqli("localhost", "root", "", "paprag");
  if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['response' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
  }
  return $conn;
}

// Function to fetch data by fid group
function fetchData($fidGroup)
{
  $conn = getDatabaseConnection();
  $placeholders = implode(',', array_fill(0, count($fidGroup), '?'));
  $sql = "SELECT fid, text FROM test2 WHERE fid IN ($placeholders)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param(str_repeat('i', count($fidGroup)), ...$fidGroup);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[$row['fid']] = $row['text'];
    }
    echo json_encode(['response' => 'success', 'data' => $data]);
  } else {
    http_response_code(500);
    echo json_encode(['response' => 'SQL Error: ' . $stmt->error]);
  }

  $stmt->close();
  $conn->close();
}

// Main logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;
  if ($action === 'getAll') {
    fetchData([3, 4, 5]);
  } elseif ($action === 'getAll2') {
    fetchData([6, 7, 8]);
  } else {
    http_response_code(400);
    echo json_encode(['response' => 'Invalid action.']);
  }
} else {
  http_response_code(405);
  echo json_encode(['response' => 'Only POST requests are allowed.']);
}
