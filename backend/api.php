<?php
require_once 'db.php';
header('Content-Type: application/json');

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
        $data = json_decode(file_get_contents('php://input'), true);
        $title = $data['title'] ?? '';
        $category_id = $data['category_id'] ?? 0;

        if ($title) {
            $stmt = $pdo->prepare("INSERT INTO list (Title, category_id, active, creation_date) VALUES (?, ?, 1, CURDATE())");
            $stmt->execute([$title, $category_id]);
            echo json_encode(['status' => 'success', 'message' => 'List added']);
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
        $name = $data['name'] ?? '';
        $list_id = $data['list_id'] ?? 0;
        $quantity = $data['quantity'] ?? 1;
        $unit = $data['unit'] ?? 'pcs';

        if ($name && $list_id) {
            $stmt = $pdo->prepare("INSERT INTO item (list_id, name, quantity, measuring_unit, completed) VALUES (?, ?, ?, ?, 0)");
            $stmt->execute([$list_id, $name, $quantity, $unit]);
            echo json_encode(['status' => 'success', 'message' => 'Item added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
        break;

    default:
        echo json_encode($response);
}
?>

