<?php
session_start();

// Check if the user is logged in and has the admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../guard/login.php");
    exit();
}

// Include the database connection file
include './connect/connect.php';

// Initialize message variable
$message = '';

// Check if ID is provided and handle deletion
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if the menu item is referenced in the orders table
    $check_sql = "SELECT COUNT(*) AS count FROM orders WHERE menu_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Menu item is referenced in the orders table, cannot delete
        $message = "Cannot delete menu item as it is referenced in existing orders."; //ถ้ามีออเดอร์สินค้านี้อยู่จะลบไม่ได้
    } else {
        // Prepare and execute SQL statement to delete the menu item
        $sql = "DELETE FROM menu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $message = "Menu item deleted successfully!";
        } else {
            $message = "Failed to delete menu item: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();

// Redirect to the menu management page with a success or error message
header("Location: admin_menu.php?message=" . urlencode($message));
exit();
