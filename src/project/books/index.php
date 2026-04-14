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
            <h1>Welcome to DLR Lexicon</h1>
            <p>DLR Lexicon, branded as dlr LexIcon, is a building in Dún Laoghaire, Ireland, housing the main public library and cultural centre of Dún Laoghaire–Rathdown County Council.</p>
            <a href="book_list.php"><button>Library Dashboard</button></a>
        </div>
    </div>
</body>
</html>