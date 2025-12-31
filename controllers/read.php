<?php
include "config/config.php";
//read data from database
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
// 2. Write the SQL query
    $sql = "SELECT * FROM store";
    $result = $conn->query($sql);
}
?>