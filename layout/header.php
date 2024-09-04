<?php
include './connect/connect.php'; // Adjust path if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop</title>
    <style>
        /* Custom styles for sidebar positioning */
        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 250px; /* Set width for the sidebar */
            height: 100vh; /* Full height */
            border-right: 2px solid #e5e7eb; /* Add a right border for separation */
        }

        .sidebar .btn-empty {
            margin-bottom: 1rem;
        }

        .sidebar .navbar-bar {
            padding: 1rem;
            text-align: center;
            font-weight: bold;
        }

        .sidebar .dropdown-menu {
            margin-bottom: 1rem;
        }

        /* Move logout button to the bottom */
        .sidebar .logout-btn {
            margin-top: auto;
        }
    </style>
</head>

<body class="flex">
    <div class="sidebar">
        <a href="../index.php" class="navbar-bar">Shop</a> <!-- Top bar in sidebar -->

        <?php if (isset($_SESSION['username'])): ?>
            <div class="text-center p-2">
                <p class="text-gray-700">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            </div>

            <?php 
            // Check user role and display menu accordingly
            if (isset($_SESSION['role'])):
                $role = $_SESSION['role']; 
            ?>

                <?php if ($role === 'admin'): ?>
                    <a href="./admin_dashboard.php" class="btn btn-empty w-full">Dashboard</a>
                    <a href="./admin_member.php" class="btn btn-empty w-full">Members</a>
                    <a href="./admin_menu.php" class="btn btn-empty w-full">Menu</a>
                    <a href="./admin_add_menu.php" class="btn btn-empty w-full">Add Menu</a>
                
                <?php elseif ($role === 'employee'): ?>
                    <a href="./employee_order.php" class="btn btn-empty w-full">Order</a>

                <?php elseif ($role === 'member'): ?>
                    <a href="./member_menu.php" class="btn btn-empty w-full">MENU</a>

                <?php elseif ($role === 'user'): ?>
                    <a href="./user_menu.php" class="btn btn-empty w-full">MENU</a>
                    <!-- Register button visible only to 'user' role -->
                    <a href="./membership.php" class="btn btn-empty w-full">Membership</a>

                <?php endif; ?>
                
            <?php endif; ?>

            <a href="guard/logout.php" class="btn w-full mt-auto logout-btn">Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>
