<?php
    class StudentFileV3 {
        protected $name;
        protected $number;

        public function __construct($name, $num) {
            $this->name = $name;
            $this->number = $num;

            try {
                $studentID = new StudentFileV3("Alice", "");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage("Student number cannot be empty");
            }
        }

        public function getName() {
            return $this->name;
        }

        public function getNumber() {
            return $this->number;
           
        }

        
        
    }
    
?>