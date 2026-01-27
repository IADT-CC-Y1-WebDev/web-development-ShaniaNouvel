<?php
    class Student {
        protected $name;
        protected $number;

        private static $count = 0;

        public function __construct($name, $num) {
            self::$count++;

            // echo "Creating student: $name...<br>";
            $this->name = $name;
            $this->number = $num;

            if ($num === "") {
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

        public static function getCount() {
            
        }

    }
    
?>
