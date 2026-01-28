<?php
    class Student {
        protected $name;
        protected $number;

        private static $students = [];
        private static $count = 0;

        public function __construct($name, $num) {
            self::$students[$num] = $this;

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
            $format = " Student: %s, N%s";
            return sprintf($format, $this->name, $this->number);
        }

        public static function getCount() {
            return count(self::$students);
        }

        public static function findAll() {
            return self::$students;
        }

        public static function findByNumber($num) {
            return self::$students[$num] ?? null;
        }


    }
    
?>
