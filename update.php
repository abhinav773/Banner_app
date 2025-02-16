<?php
include 'config.php';
if (isset($_GET['id'])) {
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM banners WHERE id = $id");
$banner = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = $_POST["link"];
    $alt_text = $_POST["alt_text"];
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $target = "uploads/" .$image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        $sql = "UPDATE banners SET image_url='$target', link='$link', alt_text='$alt_text' WHERE id=$id";
    } else {
        $sql = "UPDATE banners SET link='$link', alt_text='$alt_text' WHERE id=$id";
    }
    
    if ($conn->query($sql) === TRUE) {
       // header("Location: index.php");
        header("Location: index.php?message=Banner details updated successfully&type=success");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Edit Banner</h2>
    <form method="POST" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="<?= $banner['image_url'] ?>" width="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="link" class="form-control" value="<?= $banner['link'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" value="<?= $banner['alt_text'] ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Banner</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back</a>
</body>
</html>
