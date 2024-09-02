<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: guard/login.php"); // ถ้ายังไม่ล็อกอินให้ไปที่หน้า login
    exit();
}

// รวมไฟล์ header และ footer
include './layout/header.php';
include './layout/footer.php';
?>

