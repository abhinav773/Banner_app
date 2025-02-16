<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
   $query = "SELECT image_url FROM banners WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image_path = $row['image_url'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $delete_query = "DELETE FROM banners WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: index.php?message=Banner deleted successfully&type=success");
    } else {
        header("Location: index.php?message=Failed to delete banner&type=error");
    }
} else {
    header("Location: index.php?message=Invalid request&type=error");
}
