<?php
session_start();

// Check if the user is logged in and has the admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../guard/login.php");
    exit();
}

// Include the database connection file
include './connect/connect.php';

// Initialize variables
$id = $name = $description = $price = $image_url = '';
$message = '';

// Fetch the menu item details if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $menu_item = $result->fetch_assoc();
        $name = $menu_item['name'];
        $description = $menu_item['description'];
        $price = $menu_item['price'];
        $image_url = $menu_item['image_url'];
    } else {
        $message = "Menu item not found.";
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $image_url; // Use existing image URL by default

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $upload_dir = 'uploads/';
        $image_path = $upload_dir . basename($image['name']);

        // Check if upload directory exists, if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            $image_url = $image_path;
        } else {
            $message = "Failed to upload image.";
        }
    }

    // Prepare and execute SQL statement to update the menu item
    $sql = "UPDATE menu SET name = ?, description = ?, image_url = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $name, $description, $image_url, $price, $id);

    if ($stmt->execute()) {
        // Redirect to admin_menu.php with a success message
        header("Location: admin_menu.php?message=Menu item updated successfully!");
        exit();
    } else {
        $message = "Failed to update menu item: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();

include './layout/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex">
<div class="main-content">
        <h1 class="text-3xl font-bold mb-6">Edit Menu Item</h1>
        
        <?php if (!empty($message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($message); ?></span>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <table class="table-auto w-full bg-white shadow-md rounded-lg">
                    <tbody>
                        <tr class="border-t">
                            <td class="border px-4 py-2 rounded-tl-lg">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Menu Name:</label>
                            </td>
                            <td class="border px-4 py-2 rounded-tr-lg">
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <textarea id="description" name="description" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($description); ?></textarea>
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="file" id="image" name="image" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <?php if (!empty($image_url)): ?>
                                    <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Current Image" class="mt-2 max-w-xs">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="border px-4 py-2 rounded-bl-lg">
                                <label for="submit" class="block text-gray-700 text-sm font-bold mb-2"></label>
                            </td>
                            <td class="border px-4 py-2 rounded-br-lg">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Update Menu Item</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</body>
</html>

<?php
include './layout/footer.php';
?>
