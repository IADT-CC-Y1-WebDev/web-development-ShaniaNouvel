<?php

class Publisher {
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

    // Find all genres
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name");
        $stmt->execute();

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }

    // Find genre by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }

        return null;
    }

    public function save()
    {
        // TODO: Implement this method
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare("
                UPDATE publishers
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
                INSERT INTO publishers (name)
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

        $stmt = $this->db->prepare("DELETE FROM publishers WHERE id = :id");
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
