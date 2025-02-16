<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<?php
include 'config.php';
$result = $conn->query("SELECT * FROM banners order by id desc");
?>
<body class="container mt-4">
<div class="d-flex justify-content-between align-items-center">
    <h2>Banners</h2>
    <a href="create.php" class="btn btn-primary">Add New Banner</a>
</div>
<?php if (isset($_GET['message'])): ?>
    <div id="alertMessage" class="alert alert-<?php echo $_GET['type'] === 'success' ? 'success' : 'danger'; ?>">
        <?php echo $_GET['message']; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var alertBox = document.getElementById("alertMessage");
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s ease-out";
                    alertBox.style.opacity = "0";
                    setTimeout(function() {
                        alertBox.remove();
                    }, 500);
                }
            }, 3000);
        });
    </script>
<?php endif; ?>


<table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Link</th>
            <th>Alt Text</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><img src="<?= $row["image_url"] ?>" width="100"></td>
                <td><a href="<?= $row["link"] ?>" target="_blank"><?= $row["link"] ?></a></td>
                <td><?= $row["alt_text"] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete banner?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
