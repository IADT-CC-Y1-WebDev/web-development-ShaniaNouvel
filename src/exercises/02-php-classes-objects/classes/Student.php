<?php
    class Student {
        protected $name;
        protected $number;

        public function __construct($name, $num) {
            $this->name = $name;
            $this->number = $num;

            
        }

        public function getName() {
            return $this->name;
        }

        public function getNumber() {
            try {
                $student = new Student("Alice", "");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            return $this->number;

        }
    }
    
?>
