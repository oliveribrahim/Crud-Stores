<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Store Form</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/webp" href="assets/logoCrud.webp">
</head>
<body>


<main>
    <div class="form">
        <div>

            <h1 class="title">CRUD Operations</h1>
            <button class="btn addUser" id="openFormBtn">Add User</button>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert success">
                    <?= $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert error">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div id="formModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Add New Store</h2>
                    <form action="controllers/create.php" method="post">
                        <input type="text" name="name" placeholder="Store Name" class="input" required><br>
                        <select name="category" id="category">
                            <option value="software">Software</option>
                            <option value="import/export">Import/Export</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothes">Clothes</option>
                            <option value="food">Food</option>
                        </select><br>
                        <input type="number" name="market_value" placeholder="Market value" class="input" required>
                        <button class="btn" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error">
                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['updated'])): ?>
            <div class="alert success">
                <?= htmlspecialchars($_SESSION['updated'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['updated']); ?>
        <?php endif; ?>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-btn-edit">&times;</span>
                <h2>Edit Store</h2>
                <form action="controllers/update.php" method="post">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="text" name="name" id="edit_name" placeholder="Store Name" class="input" required><br>
                    <select name="category" id="edit_category">
                        <option value="software">Software</option>
                        <option value="import/export">Import/Export</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothes">Clothes</option>
                        <option value="food">Food</option>
                    </select><br>
                    <input type="number" name="market_value" id="edit_market_value" placeholder="Market value"
                           class="input" required><br>
                    <button class="btn" type="submit" name="submit">Update</button>
                </form>
            </div>
        </div>


        <div class="display-data">
            <h2>Store data</h2>
            <table border="1" class="data-table" width="1000px">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name of store</th>
                    <th>Category</th>
                    <th>Market value</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include 'controllers/read.php';
                if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row["category"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . (float)$row["market_value"] . " Million$ </td>";
                        echo "<td>";
                        echo "<button type='button' class='edit-btn'onclick='openEditModal(
                                                                        " . (int)$row["id"] . ",
                                                                        " . json_encode($row["name"]) . ",
                                                                        " . json_encode($row["category"]) . ",
                                                                        " . json_encode($row["market_value"]) . " )'>Edit</button> | ";
                        echo "<form action='controllers/delete.php' method='get' style='display: inline;'>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete_btn'>Delete</button>
                              </form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }

                ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
<script src="assets/script.js"></script>
</body>
</html>