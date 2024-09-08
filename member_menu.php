<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ./guard/login.php");
    exit();
}

// Include the database connection file
include './layout/header.php';

// Initialize the order session if it doesn't exist
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}

// Handle adding items to the order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_order'])) {
    $menu_id = intval($_POST['menu_id']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    // Store the item in the session
    if (isset($_SESSION['order'][$menu_id])) {
        $_SESSION['order'][$menu_id]['quantity'] += $quantity;
    } else {
        $_SESSION['order'][$menu_id] = [
            'menu_id' => $menu_id,
            'quantity' => $quantity,
            'name' => $_POST['name'],
            'price' => $price,
        ];
    }
}

// Handle placing the order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    foreach ($_SESSION['order'] as $item) {
        $menu_id = $item['menu_id'];
        $quantity = $item['quantity'];

        // Insert the order into the database
        $insert_sql = "INSERT INTO orders (menu_id, quantity) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param('ii', $menu_id, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    // Clear the order session after placing the order
    unset($_SESSION['order']);
    $order_message = "Order placed successfully!";
}

// Fetch menu items from the database
$sql = "SELECT id, name, description, image_url, price FROM menu";
$result = $conn->query($sql);
?>

<div class="main-content">
    <h1 class="text-3xl font-bold mb-6">Menu</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <?php
                $discounted_price = $row['price'] * 0.95;
                ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="text-gray-800 font-bold mb-4"><?php echo number_format($discounted_price, 2); ?> บาท</p> <!-- Display discounted price -->
                        <form action="" method="POST" class="flex items-center">
                            <input type="hidden" name="menu_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($discounted_price); ?>"> <!-- Use discounted price -->
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

    <!-- Place Order Button -->
    <div class="mt-4 mb-4"> <!-- Adjusted margin-top and margin-bottom -->
        <button id="placeOrderBtn" class="bg-green-500 text-white px-4 py-2 rounded-md">Place Order</button>
    </div>

    <div id="orderSummaryPopup" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-3/4 max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
        <ul id="orderSummaryList" class="mb-4">
            <?php if (!empty($_SESSION['order'])): ?>
                <?php
                $total = 0;
                foreach ($_SESSION['order'] as $item):
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                    <li class="mb-2">
                        <?php echo htmlspecialchars($item['name']); ?> - Quantity: <?php echo htmlspecialchars($item['quantity']); ?> - <?php echo number_format($item_total, 2); ?> บาท
                    </li>
                <?php endforeach; ?>
                <li class="font-bold mt-4">Total: <?php echo number_format($total, 2); ?> บาท</li>
            <?php else: ?>
                <li>No items in the order.</li>
            <?php endif; ?>
        </ul>
        <form action="" method="POST">
            <button type="submit" name="place_order" class="bg-blue-500 text-white px-4 py-2 rounded-md">Confirm Order</button>
            <button type="button" id="cancelOrderBtn" class="ml-4 bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
        </form>
    </div>
</div>



<?php if (isset($order_message)): ?>
    <div id="orderMessage" class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
        <span class="block sm:inline"><?php echo htmlspecialchars($order_message); ?></span>
        <div id="progressBar" class="bg-green-700 h-2 mt-2 rounded"></div>
    </div>
<?php endif; ?>

<?php
$conn->close();
include './layout/footer.php';
?>

<script>
// Toggle order summary popup
document.getElementById('placeOrderBtn').addEventListener('click', function() {
    document.getElementById('orderSummaryPopup').classList.remove('hidden');
});

document.getElementById('cancelOrderBtn').addEventListener('click', function() {
    document.getElementById('orderSummaryPopup').classList.add('hidden');
});

// Hide the order message after 10 seconds with a progress bar
window.onload = function() {
    var orderMessage = document.getElementById('orderMessage');
    var progressBar = document.getElementById('progressBar');
    if (orderMessage) {
        var duration = 5000; // 10 seconds
        var stepTime = 50; // Update every 50ms
        var width = 100;
        var decrement = (stepTime / duration) * 100;

        var interval = setInterval(function() {
            width -= decrement;
            if (width <= 0) {
                width = 0;
                clearInterval(interval);
                orderMessage.style.display = 'none';
            }
            progressBar.style.width = width + '%';
        }, stepTime);
    }
};
</script>
