<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 8: Model Class Basics - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-08-model-basics.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 8: Book Class Basics</h1>

        <h2>Task</h2>
        <p>Implement the basic structure of the Book class in <code>classes/Book.php</code>.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Implement the constructor to:
                <ul>
                    <li>Get the DB connection from the singleton</li>
                    <li>Populate properties from $data array if provided</li>
                </ul>
            </li>
            <li>Implement the <code>toArray()</code> method</li>
        </ol>

        <h3>Test Your Implementation:</h3>
        <div class="output">
            <?php
            class BookBasic
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

            // Test 1: Create empty Book
            $book = new BookBasic();
            echo "<h4>Test 1: Empty Book</h4>";
            echo "<p>Title: " . ($book->title ?? 'null') . "</p>";

            // Test 2: Create Book from data
            $data = [
                'id' => 99,
                'title' => 'Test Book',
                'author' => 'Test Author',
                'publisher_id' => 1,
                'year' => 2024,
                'isbn' => '123-456-789',
                'description' => 'A test book',
                'cover_filename' => 'test.jpg'
            ];
            $book2 = new BookBasic($data);
            echo "<h4>Test 2: Book from Data</h4>";
            echo "<p>Title: " . htmlspecialchars($book2->title ?? 'NOT IMPLEMENTED') . "</p>";
            echo "<p>Author: " . htmlspecialchars($book2->author ?? 'NOT IMPLEMENTED') . "</p>";

            // Test 3: toArray
            echo "<h4>Test 3: toArray()</h4>";
            $array = $book2->toArray();
            if (empty($array)) {
                echo "<p class='warning'>toArray() not implemented yet</p>";
            } else {
                echo "<pre>" . print_r($array, true) . "</pre>";
            }

            $db = DB::getInstance()->getConnection();

            $stmt = $db->query("SELECT * FROM books WHERE id = 1");
            $row = $stmt->fetch();

            $book2 = new BookBasic($data);

            echo $book->title; 
            ?>
        </div>
    </div>
</body>
</html>
