<?php
include "../config/config.php";

// Check if delete_id is in the URL
if (isset($_GET["delete_id"])) {
    $id = (int)$_GET["delete_id"];
    $stmt = $conn->prepare("DELETE FROM store WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php");
}
?>
