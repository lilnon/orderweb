<?php
session_start();

// Check if user is logged in and has the admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./guard/login.php");
    exit();
}

// Include header
include './layout/header.php';

// Fetch menu items from the database
include './connect/connect.php';

// Fetch total revenue, handle null values
$sql = "SELECT SUM(price * quantity) as total_revenue 
        FROM orders 
        JOIN menu ON orders.menu_id = menu.id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$total_revenue = $data['total_revenue'] ?? 0; // Default to 0 if null

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css">
    <style>
        .card {
            @apply bg-white shadow-md rounded-lg p-6 mb-4;
        }
    </style>
</head>
<body class="bg-gray-100 font-[Itim]">
<div class="main-content">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Total Orders -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-2">Total Orders</h2>
                <?php
                // Fetch total orders count
                $sql = "SELECT COUNT(*) as total_orders FROM orders";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                ?>
                <p class="text-2xl"><?php echo htmlspecialchars($data['total_orders']); ?></p>
            </div>
            
            <!-- Card 2: Total Menu Items -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-2">Total Menu Items</h2>
                <?php
                // Fetch total menu items count
                $sql = "SELECT COUNT(*) as total_menu FROM menu";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                ?>
                <p class="text-2xl"><?php echo htmlspecialchars($data['total_menu']); ?></p>
            </div>

            <!-- Card 3: Total Users -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-2">Total Users</h2>
                <?php
                // Fetch total users count
                $sql = "SELECT COUNT(*) as total_users FROM users";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                ?>
                <p class="text-2xl"><?php echo htmlspecialchars($data['total_users']); ?></p>
            </div>

            <!-- Card 4: Total Revenue -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-2">Total Revenue</h2>
                <?php
                // Display total revenue with default to 0 if null
                ?>
                <p class="text-2xl"><?php echo htmlspecialchars(number_format($total_revenue, 2)); ?> THB</p>
            </div>
        </div>
    </div>
    
    <!-- Include footer -->
    <?php include './layout/footer.php'; ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
