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

// Handle adding items to the order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_order'])) {
    $menu_id = intval($_POST['menu_id']);
    $quantity = intval($_POST['quantity']);

    // Insert the order into the database
    $insert_sql = "INSERT INTO orders (menu_id, quantity) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param('ii', $menu_id, $quantity);
    $stmt->execute();
    $stmt->close();
}

// Fetch menu items from the database
$sql = "SELECT id, name, description, image_url, price FROM menu";
$result = $conn->query($sql);
?>

<div class="container mx-auto mt-10 pl-4 px-4">
    <h1 class="text-3xl font-bold mb-6">Menu</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="text-gray-800 font-bold mb-4">$<?php echo htmlspecialchars($row['price']); ?></p>
                        <form action="" method="POST" class="flex items-center">
                            <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <input type="number" name="quantity" value="1" min="1" class="w-16 border-gray-300 rounded-md">
                            <button type="submit" name="add_to_order" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md">Add to Order</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-gray-600">No menu items available.</p>
        <?php endif; ?>
    </div>
</div>

<?php
$conn->close();
?>
