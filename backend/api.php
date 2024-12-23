<?php
require_once 'db.php'; // Ensure this file exists and is configured correctly

// Test the database connection
try {
    $stmt = $pdo->query("SELECT 1");
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'] ?? '';
$response = ['status' => 'error', 'message' => 'Invalid request'];

switch ($action) {
    // Fetch all lists
    case 'getLists':
        $stmt = $pdo->prepare("SELECT * FROM list");
        $stmt->execute();
        $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'data' => $lists]);
        break;

    // Add a new list
    case 'addList':
    // Decode JSON input from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Log the incoming data for debugging
    error_log("Incoming data: " . json_encode($data));

    $title = $data['title'] ?? '';
    $category_id = $data['category_id'] ?? 0;

    if (!empty($title)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO list (Title, category_id, active, creation_date) VALUES (?, ?, 1, CURDATE())");
            $stmt->execute([$title, $category_id]);

            echo json_encode(['status' => 'success', 'message' => 'List added']);
        } catch (PDOException $e) {
            // Log the SQL error
            error_log("Database error: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Database error', 'details' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Title is required']);
    }
    break;



    // Delete a list
    case 'deleteList':
        $list_id = $_GET['list_id'] ?? 0;
        $stmt = $pdo->prepare("DELETE FROM list WHERE ListID = ?");
        $stmt->execute([$list_id]);
        echo json_encode(['status' => 'success', 'message' => 'List deleted']);
        break;

    // Fetch items for a specific list
    case 'getItems':
        $list_id = $_GET['list_id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM item WHERE list_id = ?");
        $stmt->execute([$list_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'data' => $items]);
        break;

    // Add an item to a list
    case 'addItem':
        $data = json_decode(file_get_contents('php://input'), true);
        error_log(json_encode($data)); // Debug incoming data

        $name = $data['name'] ?? '';
        $list_id = $data['list_id'] ?? 0;
        $quantity = $data['quantity'] ?? 1;
        $unit = $data['unit'] ?? 'pcs';

        if (!empty($name) && !empty($list_id)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO item (list_id, name, quantity, measuring_unit, completed) VALUES (?, ?, ?, ?, 0)");
                $stmt->execute([$list_id, $name, $quantity, $unit]);
                echo json_encode(['status' => 'success', 'message' => 'Item added']);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Database error']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
        break;

    default:
        ob_clean();
        echo json_encode($response);
}
?>

