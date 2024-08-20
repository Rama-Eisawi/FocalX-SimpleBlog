<?php require 'index.php';
$post = new Post($db);
$posts = $post->listAll(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5  ">
        <h1 class="text-center">Blog Posts</h1>
        <hr>
        <a href="create_post.php" class="btn btn-primary mb-3">Create New Post</a>

        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($post['content'], 0, 100)); ?>...</p>
                            <p class="card-text"><small class="text-muted">By <?php echo htmlspecialchars($post['author']); ?> on <?php echo htmlspecialchars($post['created_at']); ?></small></p>
                            <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn btn-info">View</a>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>