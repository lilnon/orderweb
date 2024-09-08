<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ./guard/login.php");
    exit();
}

// Include the database connection file
include './layout/header.php';
include './layout/footer.php';

// Fetch users from the database
$sql = "SELECT id, username, role FROM users";
$result = $conn->query($sql);
?>

<div class="main-content">
    <h1 class="text-3xl font-bold mb-6">Users</h1>
    <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg p-6">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 rounded-tl-lg">ID</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2 rounded-tr-lg">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="border-t">
                            <td class="border px-4 py-2"><?php echo $row['id']; ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['username']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['role']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-600">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>
