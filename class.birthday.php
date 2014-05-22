<?php

/* PHP class to obtain certain data from a given birthdate */

class Birthday {

    private $nextdate;
    private $age;
    private $daystogo;

    public function __construct($date) {
        $test_date = strtotime(date('Y').'-'.date('m-d', strtotime($date)));
        $this->nextdate = ($test_date >= strtotime(date('Y-m-d')) ? date('Y-m-d', $test_date) : date('Y-m-d', strtotime("+1 year", $test_date)));
        $this->age = date('Y', strtotime($this->nextdate)) - date('Y', strtotime($date));
        $this->daystogo = abs(ceil((strtotime($this->nextdate) - time())/(60*60*24)));
    }

    public function getNextDate() {
        return $this->nextdate;
    }

    public function getAge() {
        return $this->age;
    }

    public function getDaysToGo() {
        return $this->daystogo;
    }

    public function isToday() {
        return ($this->nextdate == date('Y-m-d'));
    }
}

?>
