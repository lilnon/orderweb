<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ./guard/login.php");
    exit();
}

// Include the database connection file
include './connect/connect.php'; // Make sure this path is correct
include './layout/header.php';
include './layout/footer.php';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    // Update the status in the database
    $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('si', $status, $order_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch orders from the database, including order details
$sql = "SELECT o.id, 
               GROUP_CONCAT(m.name SEPARATOR ', ') AS items, 
               GROUP_CONCAT(o.quantity SEPARATOR ', ') AS quantities, 
               o.status 
        FROM orders o 
        JOIN menu m ON o.menu_id = m.id 
        GROUP BY o.id";
$result = $conn->query($sql);
?>

<div class="container mx-auto mt-10 pl-4 px-4">
    <h1 class="text-3xl font-bold mb-6">Order Status</h1>
    <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">Items Ordered</th>
                <th class="px-4 py-2">Quantities</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['id']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['items']); ?></td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['quantities']); ?></td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 rounded-full 
                                <?php echo $row['status'] === 'Finished' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white'; ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td class="border px-4 py-2">
                            <form action="" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="hidden" name="status" value="<?php echo $row['status'] === 'Finished' ? 'Not Finished' : 'Finished'; ?>">
                                <button type="submit" name="update_status" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                    <?php echo $row['status'] === 'Finished' ? 'Mark as Not Finished' : 'Mark as Finished'; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-4">No orders available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
?>
