<!DOCTYPE html>
<html lang="en">
<head>
 <?php
 require "../body/before_body.php";
 ?>
 <script>
    // JavaScript to remove alert message after 3 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.display = 'none';
        });
    }, 3000); // 3000 milliseconds = 3 seconds
 </script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Create Category</h3>
                </div>
                <div class="card-body">
                    <?php
                    include '../config/config.php';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST['name'];

                        $sql = "INSERT INTO categories (name) VALUES ('$name')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success'>New category created successfully</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                        }
                    }
                    ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
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
