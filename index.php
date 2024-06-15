<?php
session_start();

// Initialize tasks if not already set
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle form submission to add tasks
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    $_SESSION['tasks'][] = $task;
    header("Location: index.php");
    exit();
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>To-Do List</h1>
    <form action="index.php" method="post">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit">Add Task</button>
    </form>
    <h2>Tasks</h2>
    <ul>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
            <li><?php echo $task; ?> <a href="?delete=<?php echo $index; ?>" class="delete">Delete</a></li>
        <?php endforeach; ?>
        <?php if (empty($_SESSION['tasks'])): ?>
            <li>No tasks yet.</li>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
