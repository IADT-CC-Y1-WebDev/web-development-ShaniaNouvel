<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
require_once 'php/lib/forms.php';

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
        <title>Books</title>
    </head>
    <body>
        <div class="container" style="padding: 0px">
            <div class="width-12">
            <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12 header">
                <h1>The Cosy Corner</h2>
            </div>
            <div class="width-12 filters navBar" style="flex-direction: row; gap: 5px">
                    <a href="index.php"><button class="largeButton buttonLight"><i class="fa-regular fa-newspaper"></i>Home</button></a>
                    <button class="tablinks largeButton buttonDark" onclick="openDash(event, 'booksD')"><i class="fa-solid fa-pen-fancy"></i>Books</button>
                    <button class="tablinks largeButton buttonDark" onclick="openDash(event, 'publishersD')"><i class="fa-solid fa-location-dot"></i>Publishers</button>
                    <button class="tablinks largeButton buttonDark" onclick="openDash(event, 'formatsD')"><i class="fa-solid fa-list"></i>Formats</button>
            </div>
        </div>
        <section class="books">
            <div id="booksD" class="container tabcontent">
                <?php if (!empty($books)) { ?>
                    <div class="width-12 filters">
                        <form id="filters_books">
                            <div>
                                <a href="book_create.php" ><button type="button" class="buttonDark">Add New Book</button></a>
                            </div>
                            <div class="input">
                                <label for="title_filter">Title:</label>
                                <input type="text" id="title_filter" name="title_filter">
                            </div>
                            <div class="input">
                                <label for="publisher_filter">Publishers:</label>
                                <select id="publisher_filter" name="publisher_filter">
                                    <option value="">All Publishers</option>
                                    <?php foreach ($publishers as $publisher) { ?>
                                        <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input">
                                <label for="format_filter">Format:</label>
                                <select id="format_filter" name="format_filter">
                                    <option value="">All Formats</option>
                                    <?php foreach ($formats as $format) { ?>
                                        <option value="<?= h($format->id) ?>"><?= h($format->name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input">
                                <label class="filter-label" for="sort_by">Sort:</label>
                                <div>
                                    <select id="sort_by" name="sort_by">
                                        <option value="title_asc">Title A–Z</option>
                                        <option value="year_desc">Year (newest first)</option>
                                        <option value="year_asc">Year (oldest first)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="buttonLight" id="apply_filters">Apply Filters</button>
                                <button type="button" class="buttonDark" id="clear_filters">Clear Filters</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if (empty($books)) { ?>
                    <div class="width-12 ">
                        <p class="error-summary width-12">No books found.</p>
                    </div>
                <?php } else { ?>
                    <div id="book_cards" class="width-12 cards">
                        <?php foreach ($books as $book) { ?>
                            <div class="card bookCard"
                                data-title="<?= htmlspecialchars($book->title) ?>"
                                data-publisher="<?= htmlspecialchars($book->publisher_id) ?>"
                                data-format="<?= htmlspecialchars($book->format_ids ?? '')?>"
                                data-year="<?= $book->year ?>">
                                <div class="top-content">
                                    <h2><?= h($book->title) ?></h2>
                                    <p>By <?= h($book->author) ?></p>
                                </div>
                                <div class="bottom-content">
                                    <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
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
        </section>
        <section class="publisher">
            <div id="publishersD" class="container tabcontent hideDiv">
                <?php if (!empty($books)) { ?>
                    <div class="width-12 filters">
                            <div class="dropHolder">
                                <form action="publisher_store.php" style="margin-bottom: 0px;" method="POST" enctype="multipart/form-data">
                                    <div class="dropDown hideDiv" id="showPublisher" style="flex-direction: column;">
                                        <div style="display: flex; flex-direction: column; gap: 5px">
                                            <div>
                                                <input style="margin-bottom: 10px" type="text" placeholder="Publisher name" id="publisher_name" name="publisher_name">
                                                <p ><?= error('publisher_name') ?></p>
                                            </div>
                                        </div>
                                        <button class="buttonDark largeButton" type="submit">Add Publisher</button>
                                    </div>
                                </form>
                            </div>
                        <form id="filters_publisher">
                            <button onclick="addNew('showPublisher')" type="button" class="buttonDark">New Publisher</button>
                            <div class="input">
                                <label for="publisher_filter">Title:</label>
                                <input type="text" id="publisher_filter" name="publisher_filter">
                            </div>
                            <div class="input">
                                <label class="filter-label" for="sort_by">Sort:</label>
                                <div>
                                    <select id="sort_by" name="sort_by">
                                        <option value="pub_asc">Publisher A–Z</option>
                                        <option value="id_desc">Newest</option>
                                        <option value="id_asc">Oldest</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="buttonLight" id="apply_publisher">Apply Filters</button>
                                <button type="button" class="buttonDark" id="clear_publisher">Clear Filters</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if (empty($books)) { ?>
                    <div class="width-12 ">
                        <p class="error-summary width-12">No books found.</p>
                    </div>
                <?php } else { ?>
                    <div id="publisher_cards" class="width-12 cards">
                        <?php foreach ($publishers as $publisher) { ?>
                            <div class="card pubCard"
                            data-publisher="<?= htmlspecialchars($publisher->name) ?>"
                            data-id="<?= $publisher->id ?>">
                                <div class="top-content">
                                    <p><?= h($publisher->name) ?></p>
                                </div>
                                <div class="bottom-content" style="flex-direction: row">
                                    <div class="actions">
                                        <form action="publisher_update.php" style="margin-bottom: 0px;" method="POST" enctype="multipart/form-data">
                                            <div class="input">
                                                <input type="hidden" name="id" value="<?= $publisher->id ?>">
                                            </div>
                                            <div class="input auDash hideDiv" style="flex-direction: column; width: auto; align-items: center;">
                                                <div style="display: flex; gap: 5px">
                                                    <div>
                                                        <input style="margin-bottom: 10px" type="text" placeholder="Publisher name" id="publisher_name" name="publisher_name" value="<?= old('publisher_name', $publisher->name) ?>">
                                                        <p ><?= error('publisher_name') ?></p>
                                                    </div>
                                                </div>
                                                <button class="buttonLight" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="actions">
                                        <a onclick="addButton(this)">Edit</a>/
                                        <a href="publisher_delete.php?id=<?= h($publisher->id) ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
        <section class="formats">
            <div id="formatsD" class="container tabcontent hideDiv">
                <?php if (!empty($books)) { ?>
                    <div class="width-12 filters">
                        <div class="dropHolder">
                            <form action="format_store.php" style="margin-bottom: 0px;" method="POST" enctype="multipart/form-data">
                                <div class="dropDown hideDiv" id="showFormat" style="flex-direction: column;">
                                    <div style="display: flex; flex-direction: column; gap: 5px">
                                        <div>
                                            <input style="margin-bottom: 10px" type="text" placeholder="Format name" id="format_name" name="format_name">
                                            <p ><?= error('format_name') ?></p>
                                        </div>
                                    </div>
                                    <button class="buttonDark largeButton" type="submit">Add Formats</button>
                                </div>
                            </form>
                        </div>
                        <form id="filters_format">
                            <button onclick="addNew('showFormat')" type="button" class="buttonDark">New Formats</button>
                            <div class="input">
                                <label for="format_filter">Title:</label>
                                <input type="text" id="format_filter" name="format_filter">
                            </div>
                            <div class="input">
                                <label class="filter-label" for="sort_by">Sort:</label>
                                <div>
                                    <select id="sort_by" name="sort_by">
                                        <option value="form_asc">Format A–Z</option>
                                        <option value="formId_desc">Newest</option>
                                        <option value="formId_asc">Oldest</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="buttonLight" id="apply_format">Apply Filters</button>
                                <button type="button" class="buttonDark" id="clear_format">Clear Filters</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if (empty($books)) { ?>
                    <div class="width-12 ">
                        <p class="error-summary width-12">No books found.</p>
                    </div>
                <?php } else { ?>
                    <div id="format_cards" class="width-12 cards">
                        <?php foreach ($formats as $format) { ?>
                            <div class="card formCard"
                            data-format="<?= htmlspecialchars($format->name) ?>"
                            data-id="<?= $format->id ?>">
                                <div class="top-content">
                                    <p><?= h($format->name) ?></p>
                                </div>
                                <div class="bottom-content" style="flex-direction: row">
                                    <div class="actions">
                                        <form action="format_update.php" style="margin-bottom: 0px;" method="POST" enctype="multipart/form-data">
                                            <div class="input">
                                                <input type="hidden" name="id" value="<?= $format->id ?>">
                                            </div>
                                            <div class="input auDash hideDiv" style="flex-direction: column; width: auto; align-items: center;">
                                                <div style="display: flex; gap: 5px">
                                                    <div>
                                                        <input style="margin-bottom: 10px" type="text" placeholder="Format name" id="format_name" name="format_name" value="<?= old('format_name', $format->name) ?>">
                                                        <p ><?= error('format_name') ?></p>
                                                    </div>
                                                </div>
                                                <button class="buttonLight" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="actions">
                                        <a onclick="addButton(this)">Edit</a>/
                                        <a href="format_delete.php?id=<?= h($format->id) ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
        <script src="https://kit.fontawesome.com/a98aef542b.js" crossorigin="anonymous"></script>
        <script src="js/books_filter.js"></script>
        <script src="js/publisher_filter.js"></script>
        <script src="js/formats_filter.js"></script>
        <script src="js/button.js"></script>
    </body>
</html>