<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $publish_date = $_POST['publish_date'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO posts (image , title, content, category_id, publish_date) VALUES ('$target_file', '$title', '$content', $category_id, '$publish_date')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "New post created successfully";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

$categories_result = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../body/before_body.php"; ?>
    <script>
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 3000);
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Post</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['success_message'])) {
                            echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
                            unset($_SESSION['success_message']);
                        } elseif (isset($_SESSION['error_message'])) {
                            echo "<div class='alert alert-danger'>" . $_SESSION['error_message'] . "</div>";
                            unset($_SESSION['error_message']);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <?php while ($row = $categories_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="publish_date">Publish Date</label>
                                <input type="date" name="publish_date" class="form-control" id="publish_date" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control-file" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>