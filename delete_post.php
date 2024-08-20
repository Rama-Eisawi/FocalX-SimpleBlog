<?php
require 'index.php';

// Check if the 'id' parameter is present in the URL (GET request)
if (isset($_GET['id'])) {
    // Create a new instance of the Post class, passing the database connection
    $post = new Post($db);
    
    // Attempt to delete the post with the specified ID
    if ($post->delete($_GET['id'])) {
        // If the post is deleted successfully, redirect to the list_posts.php page
        header("Location: list_posts.php");
        exit; // Terminate the script to ensure no further code is executed
    } else {
        // If the deletion fails, display an error message
        echo "Failed to delete post.";
    }
} else {
    // If no post ID is provided in the URL, display an error message
    echo "No post ID provided!";
    exit; // Terminate the script to prevent further execution
}
?>

<!-- Link to go back to the list of posts -->
<a href="list_posts.php" class="btn btn-secondary">Back to Posts</a>
