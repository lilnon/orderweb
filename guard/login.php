<?php
session_start(); // Ensure session is started
include '../connect/connect.php'; // Adjust path if needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) {
                // Successful login
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role']; // Store the user role in session

                // Redirect based on role
                switch ($user['role']) {
                    case 'admin':
                        header("Location: ../admin_dashboard.php");
                        break;
                    case 'employee':
                        header("Location: ../employee_order.php");
                        break;
                    case 'user':
                        header("Location: ../user_menu.php");
                        break;
                    case 'member':
                        header("Location: ../member_menu.php");
                        break;
                    default:
                        echo "Unknown role.";
                }
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
    } else {
        echo "Username and password are required.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Login</button>
                </div>
            </form>

            <p class="text-center text-gray-600 mt-4">Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Register</a></p>
        </div>
    </div>
</body>

</html>