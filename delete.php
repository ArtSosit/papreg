<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  // Database configuration
  $host = 'localhost';
  $username = 'root';
  $password = ''; // Update this if your database has a password
  $dbname = 'paprag'; // Replace with your database name

  // Create a connection to the database
  $conn = new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['response' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
  }

  // Handle single formId deletion
  if ($_POST['action'] === 'deleteform' && isset($_POST['formId'])) {
    $formId = isset($_POST['formId']) ? (int)$_POST['formId'] : 0;

    if ($formId > 0) {
      // Prepare and execute the delete query
      $stmt = $conn->prepare("DELETE FROM test2 WHERE fid = ?");
      $stmt->bind_param('i', $formId);

      if ($stmt->execute()) {
        echo json_encode(['response' => 'success']);
      } else {
        http_response_code(500);
        echo json_encode(['response' => 'Failed to delete data: ' . $stmt->error]);
      }

      $stmt->close();
    } else {
      http_response_code(400);
      echo json_encode(['response' => 'Invalid formId']);
    }
  }

  // Handle multiple formIds deletion
  else if ($_POST['action'] === 'delete3form' && isset($_POST['formIds']) && is_array($_POST['formIds'])) {
    $formIds = $_POST['formIds']; // Array of formIds

    if (count($formIds) > 0) {
      // Convert array of formIds to string for SQL query
      $ids = implode(",", $formIds);

      // SQL query to delete multiple records
      $sql = "DELETE FROM test2 WHERE fid IN ($ids)";

      if ($conn->query($sql) === TRUE) {
        echo json_encode(['response' => 'success']);
      } else {
        http_response_code(500);
        echo json_encode(['response' => 'Failed to delete data: ' . $conn->error]);
      }
    } else {
      http_response_code(400);
      echo json_encode(['response' => 'No valid formIds provided']);
    }
  } else {
    http_response_code(400);
    echo json_encode(['response' => 'Invalid request']);
  }

  // Close the database connection
  $conn->close();
  exit();
}
