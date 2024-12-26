<?php
require_once 'db.php';

ob_start(); // Start output buffering
header('Content-Type: application/json');

// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Test database connection if needed
try {
    $stmt = $pdo->query("SELECT 1");
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection error']);
    exit;
}

$action = $_GET['action'] ?? '';
$response = ['status' => 'error', 'message' => 'Invalid request'];

switch ($action) {
    case 'getLists':
        $stmt = $pdo->prepare("SELECT * FROM list");
        $stmt->execute();
        $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'data' => $lists]);
        break;

    case 'addList':
        $data = json_decode(file_get_contents('php://input'), true);
        $title = $data['title'] ?? '';
        $category_id = $data['category_id'] ?? 0;

        if (!empty($title)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO list (Title, category_id, active, creation_date) VALUES (?, ?, 1, CURDATE())");
                $stmt->execute([$title, $category_id]);
                echo json_encode(['status' => 'success', 'message' => 'List added']);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Database error', 'details' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Title is required']);
        }
        break;

    case 'deleteList':
        $list_id = $_GET['list_id'] ?? 0;
        $stmt = $pdo->prepare("DELETE FROM list WHERE ListID = ?");
        $stmt->execute([$list_id]);
        echo json_encode(['status' => 'success', 'message' => 'List deleted']);
        break;

    case 'getItems':
        $list_id = $_GET['list_id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM item WHERE list_id = ?");
        $stmt->execute([$list_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'data' => $items]);
        break;

    case 'addItem':
        $data = json_decode(file_get_contents('php://input'), true);
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
        echo json_encode($response);
}
?>

