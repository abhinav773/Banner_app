<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image = $_FILES["image"]["name"];
    $target = "uploads/" .$image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    $link = $_POST["link"];
    $alt_text = $_POST["alt_text"];

    $sql = "INSERT INTO banners (image_url, link, alt_text) VALUES ('$target', '$link', '$alt_text')";
    
    if ($conn->query($sql) === TRUE) {
      //  header("Location: index.php");
        header("Location: index.php?message=Banner added successfully&type=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Add New Banner</h2>
    <form method="POST" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Banner Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="link" class="form-control" placeholder="Enter URL" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" placeholder="Enter Alt Text" required>
        </div>
        <button type="submit" class="btn btn-success">Add Banner</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back</a>
</body>
</html>
