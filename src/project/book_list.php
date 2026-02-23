<?php
require_once __DIR__ . '/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    //$publishers = Publishers::findAll();
    //$formats  = Formats::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
</head>
<body>
    <div class="container">
        <div class="container">
            <?php if (empty($books)) { ?>
                <p>No games found.</p>
            <?php } else { ?>
                <div class="width-12 cards">
                    <?php foreach ($books as $book) { ?>
                        <div class="card">
                            <div class="top-content">
                                <h2>Title: <?= h($book->title) ?></h2>
                                <p>Release Year: <?= h($book->year) ?></p>
                            </div>
                            <div class="bottom-content">
                                <img src="images/<?= h($book->image_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                                <div class="actions">
                                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/ 
                                    <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>