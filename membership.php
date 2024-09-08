<?php
ob_start(); // Start output buffering
include './connect/connect.php'; // Adjust path if needed

session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: guard/login.php"); // ถ้ายังไม่ล็อกอินให้ไปที่หน้า login
    exit();
}

// รวมไฟล์ header และ footer
include './layout/header.php';
?>

<body class="bg-gray-100 font-[Itim]">
  
<div class="main-content">
        <form method="POST" action="">
            <button type="submit" name="upgrade_to_member" class="btn mt-4">Upgrade to Member</button>
        </form>

        <?php
        if (isset($_POST['upgrade_to_member'])) {
            $username = $_SESSION['username'];

            // Update the user's role in the database
            $sql = "UPDATE users SET role = 'member' WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                // Role updated successfully
                $_SESSION['role'] = 'member'; // Update the session variable
                
                // Redirect to member_menu.php
                header("Location: member_menu.php");
                exit(); // Ensure no further code is executed
            } else {
                // Handle errors here
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4' role='alert'>
                        <strong class='font-bold'>Error!</strong>
                        <span class='block sm:inline'>Failed to upgrade your role. Please try again later.</span>
                      </div>";
            }

            $stmt->close();
        }
        ?>

    </div>

<?php
    include './layout/footer.php';
    ob_end_flush(); // End output buffering and flush output
?>
