<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats  = Format::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Library</title>
</head>
<body>
    <div class="welcomeHolder">
        <div class="item filters" style="">
            <h1>Welcome to The Cosy Corner</h1>
            <p>The Cosy Corner, is the hub that houses thousands of stories and books of all generes, available for all ages.</p>
            <a href="book_list.php"><button class="buttonDark">Library Dashboard</button></a>
        </div>
    </div>
</body>
</html>