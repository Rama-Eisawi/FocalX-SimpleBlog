<?php
// Include the index.php file which contains the Database and Post class definitions
require 'index.php';

// Check if the 'id' parameter is present in the URL (GET request)
if (isset($_GET['id'])) {
    // Create a new instance of the Post class, passing the database connection
    $post = new Post($db);
    
    // Attempt to read the existing post with the specified ID
    $singlePost = $post->read($_GET['id']);

    // Check if the post was found
    if (!$singlePost) {
        // If the post is not found, display an error message
        echo "Post not found!";
        exit; // Terminate the script to prevent further execution
    }
} else {
    // If no post ID is provided in the URL, display an error message
    echo "No post ID provided!";
    exit; // Terminate the script to prevent further execution
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>View Post</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center" style="background-color: #e3f2fd">
        <h2>View Post</h2>
    </nav>
    <div class="container">

        <h2><?php echo $singlePost['title']; ?></h2>
        <p>By: <?php echo $singlePost['author']; ?></p>
        <p><?php echo $singlePost['content']; ?></p>
        <p>Created at: <?php echo $singlePost['created_at']; ?></p>
        <a href="edit_post.php?id=<?php echo $singlePost['id']; ?>" class="btn btn-warning">Edit</a>
        <a href="delete_post.php?id=<?php echo $singlePost['id']; ?>" class="btn btn-danger">Delete</a>
        <a href="list_posts.php" class="btn btn-secondary">Back to Posts</a>
    </div>
</body>

</html>
