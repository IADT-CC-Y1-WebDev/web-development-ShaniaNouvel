<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

$publishers = [
    ['id' => 1, 'name' => 'Penguin Random House'],
    ['id' => 2, 'name' => 'HarperCollins'],
    ['id' => 3, 'name' => 'Simon & Schuster'],
    ['id' => 4, 'name' => 'Hachette Book Group'],
    ['id' => 5, 'name' => 'Macmillan Publishers'],
    ['id' => 6, 'name' => 'Scholastic Corporation'],
    ['id' => 7, 'name' => 'O\'Reilly Media']
];

$formats = [
    ['id' => 1, 'name' => 'Hardcover'],
    ['id' => 2, 'name' => 'Paperback'],
    ['id' => 3, 'name' => 'Ebook'],
    ['id' => 4, 'name' => 'Audiobook']
];

// try {
//     $genres = Genre::findAll();
//     $platforms = Platform::findAll();
// }
// catch (PDOException $e) {
//     setFlashMessage('error', 'Error: ' . $e->getMessage());
//     redirect('/index.php');
// }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Add New Book</h1>

            </div>
            <div class="width-12">
                <form action="book_store.php" method="POST" enctype="multipart/form-data">
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= h(old('title')) ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="author">Author</label>
                        <div>
                            <input type="text" id="author" name="author" value="<?= h(old('author')) ?>" required>
                            <p><?= error('release_date') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="publisher_id">Genre:</label>
                        <div>
                            <select id="publisher_id" name="publisher_id">
                                <option value="">-- Select Publisher --</option>
                                <?php foreach ($publishers as $pub): ?>
                                    <option value="<?= $pub['id'] ?>" 
                                        <?= chosen('publisher_id', $pub['id']) ? "selected" : "" ?>
                                    >
                                        <?= h($pub['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p><?= error('publisher_id') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="year">Year</label>
                        <div>
                            <input type="text" id="year" name="year" value="<?= h(old('year')) ?>" required>
                            <p><?= error('year') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="isbn">ISBN</label>
                        <div>
                            <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>" required>
                            <p><?= error('isbn') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special">Available Formats:</label>
                        <div class="checkbox-group">
                            <?php foreach ($formats as $format): ?>
                                <label class="checkbox-label">
                                    <input type="checkbox" 
                                        name="format_ids[]" 
                                        value="<?= $format['id'] ?>"
                                        <?= chosen('format_ids' , $format['id']) ? "checked" : "" ?>
                                    >
                                    <?= h($format['name']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (error('format_id')): ?>
                        <p class="error"><?= error('format_id') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" required><?= h(old('description')) ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="cover">Image (required):</label>
                        <div>
                            <input type="file" id="cover" name="cover" accept="image/*" required>
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button  class="button" type="submit">Store Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
// Clear form data after displaying
clearFormData();
// Clear errors after displaying
clearFormErrors();
?>