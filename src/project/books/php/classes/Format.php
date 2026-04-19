<?php

class Format {
    public $id;
    public $name;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    // Find all platforms
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats ORDER BY name");
        $stmt->execute();

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }

        return $formats;
    }

    // Find platform by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Format($row);
        }

        return null;
    }

    // Find platforms by game (requires JOIN with game_platform table)
    public static function findByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT f.*
            FROM formats f
            INNER JOIN book_format bf ON f.id = bf.format_id
            WHERE bf.book_id = :book_id
            ORDER BY f.name
        ");
        $stmt->execute(['book_id' => $bookId]);

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }

        return $formats;
    }
    
    public function save()
    {
        // TODO: Implement this method
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare("
                UPDATE formats
                SET name = :name
                WHERE id = :id
            ");

            $params = [
                'name' => $this->name,
                'id' => $this->id
            ];
        } else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO formats (name)
                VALUES (:name)
            ");

            $params = [
                'name' => $this->name,
            ];
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

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
        
    }

    public function delete(){
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM formats WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);

    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
