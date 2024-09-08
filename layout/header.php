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
            position: fixed; /* Make the sidebar fixed */
            top: 0; /* Align it to the top of the viewport */
            left: 0; /* Align it to the left of the viewport */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 250px; /* กำหนดความกว้างของ sidebar */
            height: 100vh; /* ให้ sidebar สูงเต็มหน้าจอ */
            border-right: 2px solid #e5e7eb; /* ใส่เส้นแบ่งด้านขวา */
            padding: 20px;
            z-index: 1000; /* Ensure it stays above other content */
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

        /* ปุ่ม Logout อยู่ด้านล่างสุด */
        .sidebar .logout-btn {
            margin-top: auto; /* ทำให้ปุ่ม Logout อยู่ด้านล่างสุด */
            background-color: #ff5c5c; /* เพิ่มสีพื้นหลังให้ปุ่ม Logout */
            color: white; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
            padding: 10px 20px; /* เพิ่ม Padding */
            text-align: center; /* จัดข้อความกึ่งกลาง */
            border-radius: 5px; /* ปรับมุมให้โค้งมน */
            text-decoration: none; /* เอาเส้นใต้ลิงก์ออก */
        }

        .sidebar .logout-btn:hover {
            background-color: #ff0000; /* เปลี่ยนสีปุ่มเมื่อเมาส์ชี้ */
        }

        /* Adjust main content to account for the fixed sidebar */
        .main-content {
    margin-left: 250px; /* Sidebar width */
    padding: 20px;
    z-index: 500; /* Adjust this value as needed */
    position: relative; /* Ensure it's positioned in the normal document flow */
}

    </style>
</head>

<body class=" font-[Itim]">
    <div class="sidebar">
        <a class="navbar-bar">Shop</a> <!-- Top bar in sidebar -->

        <?php if (isset($_SESSION['username'])): ?>
            <div class="text-center p-2">
                <p class="text-gray-700">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            </div>

            <?php 
            // ตรวจสอบ role ของผู้ใช้แล้วแสดงเมนูที่เกี่ยวข้อง
            if (isset($_SESSION['role'])):
                $role = $_SESSION['role']; 
            ?>

                <?php if ($role === 'admin'): ?>
                    <a href="./admin_dashboard.php" class="btn btn-empty w-full">Dashboard</a>
                    <a href="./admin_member.php" class="btn btn-empty w-full">Members</a>
                    <a href="./admin_menu.php" class="btn btn-empty w-full">Menu</a>
                
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

            <!-- ปุ่ม Logout จะอยู่ด้านล่างสุดของ sidebar -->
            <a href="guard/logout.php" class="btn w-full logout-btn">Logout</a>
        <?php endif; ?>
    </div>

    <!-- Main content area with adjusted margin -->

      
</body>
</html>
