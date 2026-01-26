<?php
    class StudentFileV2 {
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
            return $this->number;
        }
    }
    
?>
