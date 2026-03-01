<?php

class Book
{
    // public properties for each database column
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;

    // private $db property for database connection
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
            $books[] = new Book($row);
        }

        return $books;
        
    }

    public static function findById($id){
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ? new Book($row) : null;
    }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    // public static function findByPublisher($publisherId)
    // {
    //     // TODO: Implement this method
    //     $db = DB::getInstance()->getConnection();
    //         $stmt = $db->prepare("SELECT * FROM books WHERE publisher_id = :publisher_id ORDER BY title");
    //         $stmt->execute(['publisher_id' => $publisher_id]);

    //         $books = [];
    //         while ($row = $stmt->fetch()) {
    //             $books[] = new Book($row);
    //         }

    //         return $books;
    // }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function save()
    {
        // TODO: Implement this method
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare("
                UPDATE books
                SET title = :title,
                    author = :author,
                    publisher_id = :publisher_id,
                    year = :year,
                    isbn = :isbn,
                    description = :description,
                    cover_filename = :cover_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
                'id' => $this->id
            ];
        } else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename, id)
                VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename, :id)
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
                // 'id' => $this->id
            ];
        }

        $status = $stmt->execute($params);

        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }
        
        $status = $stmt->execute($params);

        // Check for errors
        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }

        // Ensure one row affected
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save game.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
        
    }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function delete(){
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);

    }

    // =========================================================================
    // Exercise 8: Book Class Basics
    // =========================================================================
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
