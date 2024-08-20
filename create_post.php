<?php
// Include the index.php file which contains the Database and Post class definitions
require 'index.php';

// Check if the request method is POST, indicating that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new instance of the Post class, passing the database connection
    $post = new Post($db);

    // Assign the form data to the Post object properties
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->author = $_POST['author'];

    // Attempt to create a new post in the database
    if ($post->create()) {
        // If the post is created successfully, redirect to the list_posts.php page
        header("Location: list_posts.php");
        exit; // Terminate the script to ensure no further code is executed
    } else {
        // If the post creation fails, display an error message
        echo "Failed to create post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Post</title>
</head>

<body>

    <nav class="navbar navbar-light justify-content-center" style="background-color: #e3f2fd">
        <h2>Create New Post</h2>
    </nav>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</body>

</html>
<script>

</script>