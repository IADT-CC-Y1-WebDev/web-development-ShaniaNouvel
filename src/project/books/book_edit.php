<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No book ID provided.');
    }
    $id = $_GET['id'];

    $book = Book::findById($id);
    if ($book === null) {
        throw new Exception("Book not found.");
    }

    $bookFormats = Format::findByBook($book->id);
    $bookFormatsIds = [];
    foreach ($bookFormats as $format) {
        $bookFormatsIds[] = $format->id;
    }

    $publishers = Publisher::findAll();
    $formats = Format::findAll();
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Edit Book</title>
    </head>
    <body>
        <div class="aCard">
            <div class="container textCreate crudCss">
                <div class="width-12">
                    <?php require 'php/inc/flash_message.php'; ?>
                </div>
                <div class="width-12 headerCreate">
                    <h1>Edit Book</h1>
                </div>
                <div class="width-12">
                    <form action="book_update.php" id="book_form" method="POST" enctype="multipart/form-data" novalidate>
                        <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>
                        <div class="input">
                            <input type="hidden" name="id" value="<?= h($book->id) ?>">
                        </div>
                        <div class="input">
                            <label class="special" for="title">Title:</label>
                            <div>
                                <input type="text" id="title" name="title" value="<?= old('title', $book->title) ?>" required>
                                <p id="title_error"><?= error('title') ?></p>
                            </div>
                        </div>
                        <div class="input">
                            <label class="special" for="author">Author</label>
                            <div>
                                <input type="text" id="author" name="author" value="<?= old('author', $book->author) ?>" required>
                                <p id="author_error"><?= error('author') ?></p>
                            </div>
                        </div>
                        <div class="input">
                            <label class="special" for="publisher_id">Publishers:</label>
                            <div>
                                <select id="publisher_id" name="publisher_id">
                                    <option value="">-- Select Publisher --</option>
                                    <?php foreach ($publishers as $pub): ?>
                                        <option value="<?= h($pub->id) ?>" <?= chosen('publisher_id', $pub->id, $book->publisher_id) ? "selected" : "" ?>>
                                            <?= h($pub->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p id="publisher_id_error"><?= error('publisher_id') ?></p>
                            </div>
                        </div>
                        <div class="input">
                            <label class="special" for="year">Year</label>
                            <div>
                                <input type="text" id="year" name="year" value="<?= old('year', $book->year) ?>" required>
                                <p id="year_error"><?= error('year') ?></p>
                            </div>
                        </div>
                        <div class="input">
                            <label class="special" for="isbn">ISBN</label>
                            <div>
                                <input type="text" id="isbn" name="isbn" value="<?= old('isbn', $book->isbn) ?>" required>
                                <p id="isbn_error"><?= error('isbn') ?></p>
                            </div>
                        </div>
                    <div class="input">
                            <label class="special">Formats:</label>
                            <div>
                                <?php foreach ($formats as $format) { ?>
                                    <div style="display: flex;">
                                        <input type="checkbox" 
                                            id="format_<?= h($format->id) ?>" 
                                            name="format_ids[]" 
                                            value="<?= h($format->id) ?>"
                                            <?= chosen('format_ids', $format->id, $bookFormatsIds) ? "checked" : "" ?>
                                        >
                                        <label for="format_<?= h($format->id) ?>"><?= h($format->name) ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                            <p id="format_ids_error"><?= error('format_ids[]')?></p>
                        </div>
                        <div class="input">
                            <label class="special" for="description">Description:</label>
                            <div>
                                <textarea id="description" name="description" required><?= old('description', $book->description) ?></textarea>
                                <p id="description_error"><?= error('description') ?></p>
                            </div>
                        </div>
                        <div><img src="images/<?= $book->cover_filename ?>" /></div>
                        <div class="input">
                            <label class="special" for="cover">Image (optional):</label>
                            <div>
                                <input type="file" id="cover" name="cover" accept="image/*">
                                <p id="cover_error"><?= error('cover') ?></p>
                            </div>
                        </div>
                        <div class="input">
                            <button id='submit_btn' class="buttonLight" type="submit">Update Book</button>
                            <button class="buttonDark"><a href="book_list.php">Cancel</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/books_edit.js"></script>
    </body>
</html>
<?php
// Clear form data after displaying
clearFormData();
// Clear errors after displaying
clearFormErrors();
?>