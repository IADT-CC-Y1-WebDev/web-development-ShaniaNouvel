<?php
    class Student {
        protected $name;
        protected $number = [];

        public function __construct($name, $num) {
            // echo "Creating student: $name...<br>";
            $this->name = $name;
            $this->number = $num;

            if ($num === '') {
                throw new Exception("Student number cannot be empty");
            } 
            
        }

        public function getName() {
            return $this->name;
        }

        public function getNumber() {        
            return $this->number;
        }

        public function __toString() {
            $format = "Student: %s, N%s";
            return sprintf($format, $this->name, $this->number);
        }

    }
    
?>
