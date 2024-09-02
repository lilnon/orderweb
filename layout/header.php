<?php
include './connect/connect.php'; // Adjust path if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shabu Full</title>

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
    </style>
</head>

<body class="flex">
    <div class="sidebar">
        <a href="./index.php" class="navbar-bar">Shabu Full</a> <!-- Top bar in sidebar -->

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
                    <a href="./admin_members.php" class="btn btn-empty w-full">Members</a>
                <?php elseif ($role === 'employee'): ?>
                    <a href="./order.php" class="btn btn-empty w-full">Order</a>
                <?php elseif ($role === 'member' || $role === 'user'): ?>
                    <a href="./menu.php" class="btn btn-empty w-full">MENU</a>

                    <div class="dropdown dropdown-hover dropdown-menu">
                        <label tabindex="0" class="btn w-full">About</label>
                        <ul class="menu dropdown-content z-[166666] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="#pic">รูปภาพบรรยากาศ🖼</a></li>
                            <li><a target="_blank" href="https://www.youtube.com/watch?v=33Y3i2xosgM">รีวิว🏷</a></li>
                            <li><a href="#promotion">โปรโมชั่น🔅</a></li>
                            <li><a href="#rules">กฏในการทานของทางร้าน❌</a></li>
                        </ul>
                    </div>

                    <div class="dropdown dropdown-hover dropdown-menu">
                        <label tabindex="0" class="btn w-full">Set</label>
                        <ul class="menu dropdown-content menu-horizontal bg-base-500">
                            <li><a target="_blank" href="https://www.facebook.com/202851530525177/photos/pb.100068662921541.-2207520000/1332137854263200/?type=3">เซต 259. เนื้อ/ผัก เครื่องดื่ม บุฟเฟต์</a></li>
                            <li><a target="_blank" href="https://www.facebook.com/photo/?fbid=1332137870929865&set=pb.100068662921541.-2207520000">เซต 299. เนื้อ/ผัก/ของทะเล เครื่องดื่มสั่งได้ทุกอย่างไม่อั้น</a></li>
                            <li><a target="_blank" href="https://web.facebook.com/202851530525177/photos/pb.100068662921541.-2207520000/1332137830929869/?type=3">เซต 319. เนื้อ/ผัก/ของทะเล/เนื้อ เครื่องดื่มสั่งได้ทุกอย่างไม่อั้น</a></li>
                        </ul>
                    </div>
                    
                <?php endif; ?>
                
            <?php endif; ?>

            <a href="guard/logout.php" class="btn w-full mt-auto">Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>
