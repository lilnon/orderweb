<?php
session_start();

// Check if the user is logged in and has the admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../guard/login.php");
    exit();
}

// Include the database connection file
include './layout/header.php';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image'];
    $upload_dir = 'uploads/';
    $image_path = $upload_dir . basename($image['name']);

    // Check if upload directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($image['tmp_name'], $image_path)) {
        // Prepare and execute SQL statement to insert the new menu item
        $sql = "INSERT INTO menu (name, description, image_url, price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $description, $image_path, $price);
        if ($stmt->execute()) {
            $message = "Menu item added successfully!";
        } else {
            $message = "Failed to add menu item: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu - Shabu Full</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex">
    <div class="container mx-auto mt-10 pl-4 px-4">
        <h1 class="text-3xl font-bold mb-6">Add Menu Item</h1>
        
        <?php if (isset($message)): ?>
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
                                <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <textarea id="description" name="description" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="text" id="price" name="price" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="border px-4 py-2">
                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="file" id="image" name="image" accept="image/*" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="border px-4 py-2 rounded-bl-lg">
                                <label for="submit" class="block text-gray-700 text-sm font-bold mb-2"></label>
                            </td>
                            <td class="border px-4 py-2 rounded-br-lg">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Add Menu Item</button>
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
$conn->close();
?>

<?php
include './layout/footer.php';
?>
