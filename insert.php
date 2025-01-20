<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish a database connection (shared for all actions)
$servername = "localhost";
$username = "root"; // Change this to your DB username
$password = ""; // Change this to your DB password
$dbname = "paprag"; // Change this to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(['response' => 'Database connection failed: ' . $conn->connect_error]);
  exit();
}

// Check if this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the action from POST data
  $action = isset($_POST['action']) ? $_POST['action'] : null;

  if ($action === 'saveform') {
    // Retrieve and decode the Base64 reason
    $encodeddata = $_POST['data'] ?? null;
    $formId = $_POST['formId'] ?? null;

    if ($encodeddata && $formId) {
      $data = urldecode(base64_decode($encodeddata));

      // Use INSERT ... ON DUPLICATE KEY UPDATE
      $stmt = $conn->prepare("
        INSERT INTO test2 (fid, text, time_stamp) 
        VALUES (?, ?, NOW()) 
        ON DUPLICATE KEY UPDATE 
        text = VALUES(text),
        time_stamp = VALUES(time_stamp)
      ");
      $stmt->bind_param("is", $formId, $data);

      if ($stmt->execute()) {
        echo json_encode(['response' => 'Data saved successfully!']);
      } else {
        http_response_code(500);
        echo json_encode(['response' => 'Failed to save data: ' . $stmt->error]);
      }

      $stmt->close();
    } else {
      http_response_code(400);
      echo json_encode(['response' => 'Invalid input data.']);
    }
  } elseif ($action === 'Allsave') {
    $originInfo = $_POST['origin_info'] ?? null;
    $updatedInfo = $_POST['updated_info'] ?? null;
    $improvInfo = $_POST['improv_info'] ?? null;

    // ตรวจสอบและดึงค่าจากฐานข้อมูลถ้าค่าเป็น null หรือว่าง
    $stmt = $conn->prepare("
        SELECT 
            MAX(CASE WHEN fid = 3 THEN text END) AS origin_info,
            MAX(CASE WHEN fid = 4 THEN text END) AS updated_info,
            MAX(CASE WHEN fid = 5 THEN text END) AS improv_info
        FROM test2
    ");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // ใช้ค่าจากฐานข้อมูลถ้าค่า input เป็น null หรือว่าง
    $originInfo = $originInfo ?: $result['origin_info'] ?? "<p><br></p>";
    $updatedInfo = $updatedInfo ?: $result['updated_info'] ?? "<p><br></p>";
    $improvInfo = $improvInfo ?: $result['improv_info'] ?? "<p><br></p>";

    $stmt->close();

    // ถ้าค่าทั้งสามไม่เป็น null ให้ดำเนินการ SQL
    if ($originInfo && $updatedInfo && $improvInfo) {
      $stmt = $conn->prepare("
            INSERT INTO test2 (fid, text, time_stamp) 
            VALUES (3, ?, NOW()), (4, ?, NOW()), (5, ?, NOW())
            ON DUPLICATE KEY UPDATE 
                text = VALUES(text),
                time_stamp = VALUES(time_stamp)
        ");
      $stmt->bind_param("sss", $originInfo, $updatedInfo, $improvInfo);

      if ($stmt->execute()) {
        echo json_encode(['response' => 'Data saved successfully!']);
      } else {
        http_response_code(500);
        echo json_encode(['response' => 'Failed to save data: ' . $stmt->error]);
      }

      $stmt->close();
    } else {
      http_response_code(400);
      echo json_encode(['response' => 'Invalid input data.']);
    }
  } elseif ($action === 'Allsave2') {
    $originInfo = $_POST['origin_info'] ?? null;
    $updatedInfo = $_POST['updated_info'] ?? null;
    $improvInfo = $_POST['improv_info'] ?? null;

    // ตรวจสอบและดึงค่าจากฐานข้อมูลถ้าค่าเป็น null หรือว่าง
    $stmt = $conn->prepare("
        SELECT 
            MAX(CASE WHEN fid = 6 THEN text END) AS origin_info,
            MAX(CASE WHEN fid = 7 THEN text END) AS updated_info,
            MAX(CASE WHEN fid = 8 THEN text END) AS improv_info
        FROM test2
    ");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // ใช้ค่าจากฐานข้อมูลถ้าค่า input เป็น null หรือว่าง
    $originInfo = $originInfo ?: $result['origin_info'] ?? "<p><br></p>";
    $updatedInfo = $updatedInfo ?: $result['updated_info'] ?? "<p><br></p>";
    $improvInfo = $improvInfo ?: $result['improv_info'] ?? "<p><br></p>";

    $stmt->close();

    // ถ้าค่าทั้งสามไม่เป็น null ให้ดำเนินการ SQL
    if ($originInfo && $updatedInfo && $improvInfo) {
      $stmt = $conn->prepare("
            INSERT INTO test2 (fid, text, time_stamp) 
            VALUES (6, ?, NOW()), (7, ?, NOW()), (8, ?, NOW())
            ON DUPLICATE KEY UPDATE 
                text = VALUES(text),
                time_stamp = VALUES(time_stamp)
        ");
      $stmt->bind_param("sss", $originInfo, $updatedInfo, $improvInfo);

      if ($stmt->execute()) {
        echo json_encode(['response' => 'Data saved successfully!']);
      } else {
        http_response_code(500);
        echo json_encode(['response' => 'Failed to save data: ' . $stmt->error]);
      }

      $stmt->close();
    } else {
      http_response_code(400);
      echo json_encode(['response' => 'Invalid input data.']);
    }
  }
} else {
  http_response_code(405);
  echo json_encode(['response' => 'Only POST requests are allowed.']);
}

// Close database connection
$conn->close();
