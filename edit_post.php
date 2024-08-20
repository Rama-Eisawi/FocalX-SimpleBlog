<?php
// Include the index.php file which contains the Database and Post class definitions
require 'index.php';

// Check if the 'id' parameter is present in the URL (GET request)
if (isset($_GET['id'])) {
    // Create a new instance of the Post class, passing the database connection
    $post = new Post($db);

    // Attempt to read the existing post with the specified ID
    $existingPost = $post->read($_GET['id']);

    // Check if the post was found
    if (!$existingPost) {
        // If the post is not found, display an error message
        echo "Post not found!";
        exit; // Terminate the script to prevent further execution
    }
} else {
    // If no post ID is provided in the URL, display an error message
    echo "No post ID provided!";
    exit; // Terminate the script to prevent further execution
}

// Check if the request method is POST, indicating that the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assign the form data to the Post object properties
    $post->title = $_POST['title'];       // Set the title from the form input
    $post->content = $_POST['content'];   // Set the content from the form input
    $post->author = $_POST['author'];     // Set the author from the form input

    // Attempt to update the post in the database
    if ($post->update($_GET['id'])) {
        // If the post is updated successfully, redirect to the view_post.php page for the updated post
        header("Location: view_post.php?id=" . $_GET['id']);
        exit; // Terminate the script to ensure no further code is executed
    } else {
        // If the update fails, display an error message
        echo "Failed to update post.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Post</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center" style="background-color: #e3f2fd">

        <h2>Edit Post</h2>
    </nav>
    <div class=" container">
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $existingPost['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" required><?php echo $existingPost['content']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</body>

</html>