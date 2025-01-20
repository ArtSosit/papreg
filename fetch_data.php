<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paprag";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(['response' => 'Database connection failed.']);
  exit();
}

$action = $_GET['action'] ?? null;

if ($action === 'getform') {
  $formId = filter_var($_GET['formId'], FILTER_VALIDATE_INT);

  if ($formId) {
    if ($stmt = $conn->prepare("SELECT text FROM test2 WHERE fid = ?")) {
      $stmt->bind_param("i", $formId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
        http_response_code(200);
        echo json_encode(['response' => 'success', 'data' => $row['text']]);
      } else {
        http_response_code(404);
        echo json_encode(['response' => 'no data found']);
      }

      $stmt->close();
    } else {
      http_response_code(500);
      echo json_encode(['response' => 'error', 'message' => 'Database query failed.']);
    }
  } else {
    http_response_code(400);
    echo json_encode(['response' => 'Invalid form ID']);
  }

  $conn->close();
  exit;
} elseif ($action === "getAll") {
  $formId = $_GET['formId'] ?? null;

  if ($formId !== null) {
    $stmt = $conn->prepare("SELECT * FROM test2 WHERE fid = ?");
    $stmt->bind_param("i", $formId); // ผูกค่าพารามิเตอร์ (i หมายถึง integer)
    $stmt->execute();
    $result = $stmt->get_result();

    // ดึงข้อมูลทุกแถวในฐานข้อมูล
    if ($result->num_rows > 0) {
      $data = [];
      while ($row = $result->fetch_assoc()) {
        $data[] = $row; // เก็บแต่ละแถวในอาร์เรย์
      }
      echo json_encode(['response' => 'success', 'data' => $data]);
    } else {
      echo json_encode(['response' => 'no data found']);
    }

    $stmt->close();
  } else {
    echo json_encode(['response' => 'invalid request', 'message' => 'formId is required']);
  }
}
if ($action === 'getAll2') {
  $formIds = json_decode($_GET['formIds'] ?? '[]', true); // รับ formIds เป็น array
  if (!empty($formIds) && is_array($formIds)) {
    // สร้าง Placeholder (?) สำหรับจำนวน ID ที่ส่งมา
    $placeholders = implode(',', array_fill(0, count($formIds), '?'));

    $query = "SELECT fid,text,time_stamp FROM test2 WHERE fid IN ($placeholders)";
    $stmt = $conn->prepare($query);

    // Bind Parameters ตามจำนวน ID
    $stmt->bind_param(str_repeat('i', count($formIds)), ...$formIds);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    if (!empty($data)) {
      echo json_encode(['response' => 'success', 'data' => $data]);
    } else {
      echo json_encode(['response' => 'no data found']);
    }

    $stmt->close();
  } else {
    http_response_code(400);
    echo json_encode(['response' => 'Invalid form IDs']);
  }

  $conn->close();
}


$conn->close();
