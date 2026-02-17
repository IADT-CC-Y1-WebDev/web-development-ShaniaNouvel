<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 9: Finder Methods - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-09-finder-methods.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 9: Static Finder Methods</h1>

        <h2>Task</h2>
        <p>Implement the static finder methods in the Book class.</p>

        <h3>Methods to Implement:</h3>
        <ol>
            <li><code>findAll()</code> - Return array of all Book objects</li>
            <li><code>findById($id)</code> - Return single Book or null</li>
            <li><code>findByPublisher($publisherId)</code> - Return array of Books</li>
        </ol>

        <div>
            <?php
            class BookWithFinders
            {
                public $id;
                public $title;
                public $author;
                public $publisher_id;
                public $year;
                public $isbn;
                public $description;
                public $cover_filename;

                private $db;

                public function __construct($data = [])
                {
                    $this->db = DB::getInstance()->getConnection();

                    if (!empty($data)) {
                        $this->id = $data['id'] ?? null;
                        $this->title = $data['title'] ?? null;
                        $this->author = $data['author'] ?? null;
                        $this->publisher_id = $data['publisher_id'] ?? null;
                        $this->year = $data['year'] ?? null;
                        $this->isbn = $data['isbn'] ?? null;
                        $this->description = $data['description'] ?? null;
                        $this->cover_filename = $data['cover_filename'] ?? null;
                    }
                }

                public static function findAll()
                {
                    $db = DB::getInstance()->getConnection();
                    $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
                    $stmt->execute();

                    $books = [];
                    while ($row = $stmt->fetch()) {
                        $books[] = new BookWithFinders($row);
                    }

                    return $books;
                }

                // Find game by ID
                public static function findById($id)
                {
                    $db = DB::getInstance()->getConnection();
                    $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
                    $stmt->execute(['id' => $id]);

                    $row = $stmt->fetch();
                    if ($row) {
                        return new BookWithFinders($row);
                    }

                    return null;
                }

                // Find games by genre
                public static function findByPublisher($publisher_id)
                {
                    $db = DB::getInstance()->getConnection();
                    $stmt = $db->prepare("SELECT * FROM books WHERE publisher_id = :publisher_id ORDER BY title");
                    $stmt->execute(['publisher_id' => $publisher_id]);

                    $books = [];
                    while ($row = $stmt->fetch()) {
                        $books[] = new BookWithFinders($row);
                    }

                    return $books;
                }

                public function toArray()
                {
                    return [
                        'id' => $this->id,
                        'title' => $this->title,
                        'author' => $this->author,
                        'publisher_id' => $this->publisher_id,
                        'year' => $this->year,
                        'isbn' => $this->isbn,
                        'description' => $this->description,
                        'cover_filename' => $this->cover_filename
                    ];
                }
            }
            ?>
        </div>

        <h3>Test findAll():</h3>
        <div class="output">
            <?php
            $books = Book::findAll();
            if (empty($books)) {
                echo "<p class='warning'>findAll() not implemented or returns empty</p>";
            } else {
                echo "<p class='success'>Found " . count($books) . " books</p>";
                echo "<ul>";
                foreach (array_slice($books, 0, 3) as $book) {
                    echo "<li>" . htmlspecialchars($book->title ?? 'No title') . "</li>";
                }
                if (count($books) > 3) {
                    echo "<li>... and " . (count($books) - 3) . " more</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>

        <h3>Test findById(1):</h3>
        <div class="output">
            <?php
            $book = Book::findById(1);
            if ($book === null) {
                echo "<p class='warning'>findById() not implemented or book not found</p>";
            } else {
                echo "<p class='success'>Found book: " . htmlspecialchars($book->title ?? 'No title') . "</p>";
                echo "<p>Author: " . htmlspecialchars($book->author ?? 'No author') . "</p>";
            }
            ?>
        </div>

        <h3>Test findById(9999) - Non-existent:</h3>
        <div class="output">
            <?php
            $book = Book::findById(9999);
            if ($book === null) {
                echo "<p class='success'>Correctly returned null for non-existent book</p>";
            } else {
                echo "<p class='warning'>Should return null for non-existent ID</p>";
            }
            ?>
        </div>

        <h3>Test findByPublisher(1):</h3>
        <div class="output">
            <?php
            $books = Book::findByPublisher(1);
            if (empty($books)) {
                echo "<p class='warning'>findByPublisher() not implemented or no books found</p>";
            } else {
                echo "<p class='success'>Found " . count($books) . " books for publisher 1:</p>";
                echo "<ul>";
                foreach ($books as $book) {
                    echo "<li>" . htmlspecialchars($book->title ?? 'No title') . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</body>
</html>
