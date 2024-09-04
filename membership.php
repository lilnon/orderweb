<?php
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
  
    <div class="container mx-auto text-center mt-10">
        <form method="POST" action="">
            <button type="submit" name="upgrade_to_member" class="btn  mt-4">Upgrade to Member</button>
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
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Upgrade Successful!',
                            text: 'Your role has been upgraded to Member!',
                            confirmButtonText: 'OK'
                        });
                      </script>";
            } else {
                // Handle errors here
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Upgrade Failed',
                            text: 'Failed to upgrade your role. Please try again later.',
                            confirmButtonText: 'OK'
                        });
                      </script>";
            }

            $stmt->close();
        }
        ?>

    </div>

<?php
    include './layout/footer.php';
?>

