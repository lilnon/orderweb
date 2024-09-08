<?php
include './connect/connect.php'; // Adjust path if needed

session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: guard/login.php"); // Redirect to login page if not logged in
    exit();
}

// Include header
include './layout/header.php';

// Fetch menu items from the database
$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);

// Handle messages
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 font-[Itim]">
<div class="main-content">
        <h1 class="text-2xl font-bold mb-4">Menu Management</h1>
        
        <?php if (!empty($message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $message; ?></span>
            </div>
        <?php endif; ?>
        
        <div class="mb-4">
            <a href="admin_add_menu.php" class="btn btn-empty text-white py-2 px-4">Add Menu Item</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg p-6">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b border-gray-200 rounded-tl-lg">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200">Name</th>
                        <th class="py-2 px-4 border-b border-gray-200">Description</th>
                        <th class="py-2 px-4 border-b border-gray-200">Price</th>
                        <th class="py-2 px-4 border-b border-gray-200 rounded-tr-lg">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-t border-gray-200">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['description']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['price']); ?></td>
                                <td class="py-2 px-4">
                                    <a href="admin_edit_menu.php?id=<?php echo $row['id']; ?>" class="text-blue-500 hover:underline">Edit</a>
                                    <a href="admin_delete_menu.php?id=<?php echo $row['id']; ?>" class="text-red-500 hover:underline ml-4">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center text-gray-600">No menu items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    // Include footer
    include './layout/footer.php';
    ?>
</body>
</html>
