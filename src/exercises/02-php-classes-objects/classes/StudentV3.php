<?php
    class StudentV3 {
        public $name;
        public $number;

        public function __construct($name, $num) {
            $this->name = $name;
            $this->number = $num;
        }

        public function getName($name) {
            $this->name = $name;
        }

        public function getNumber($number) {
            $this->number = $num;
        }
    }
    
?>
