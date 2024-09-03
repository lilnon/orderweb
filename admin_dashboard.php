<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: ./guard/login.php"); // ถ้ายังไม่ล็อกอินให้ไปที่หน้า login
    exit();
}

// รวมไฟล์ header และ footer
include './layout/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 font-[Itim]">
  
<?php
    include './layout/footer.php';
?>