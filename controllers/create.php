<?php
session_start();
include("../config/config.php");
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $market_value = $_POST['market_value'];
    if (empty($name) || empty($category) || empty($market_value)) {
        $_SESSION['error'] = "All fields are required";
    } else {
        $sql = "INSERT INTO store (name, category, market_value) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssd", $name, $category, $market_value);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Record has been created";
            } else {
                $_SESSION['error'] = "Record has not been created error on executing query";
            }
        } else {
            $_SESSION['error'] = "Record has not been created error on prepared statement";
        }
        $stmt->close();
    }
    header("Location: ../index.php");
    exit();
}