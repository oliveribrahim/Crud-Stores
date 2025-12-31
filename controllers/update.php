<?php
session_start();
include "../config/config.php";
// 2. PROCESS THE UPDATE (When user clicks Submit)
if (isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $market_value = $_POST['market_value'];

    $sql = "UPDATE store SET name=?, category=?, market_value=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $name, $category, $market_value, $id);
    if (empty($name) || empty($category) || empty($market_value)) {
        $_SESSION['error'] = "Please fill in all the fields";
    } else {
        if ($stmt->execute()) {
            $_SESSION['updated'] = "Record updated successfully ✅";
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Update failed ❌";
            $stmt->close();
            header("Location: ../index.php");
            exit;
        }
    }
    header("Location: ../index.php");
    exit();
}
?>
