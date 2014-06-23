<?php

/*
** Simple PHP class to obtain next occurrence, age and days to go from a given birthdate.
** All dates and differences are DateTime objects ad DateTimeInterfaces.
*/

class Birthday {

    private $nextdate;
    private $frombirth;
    private $tonext;

    public function __construct($date) {
        $birthdate = new DateTime($date);
        $today = new DateTime("today");
        $this->nextdate = new DateTime($birthdate->format('d F')." this year");
        $this->nextdate >= $today or $this->nextdate->modify("+1 year");
        $this->frombirth = $birthdate->diff($this->nextdate);
        $this->tonext = $today->diff($this->nextdate);
    }

    public function getNextDate() {
        return $this->nextdate->format('d-m-Y');
    }

    public function getAge() {
        return $this->frombirth->format('%y');
    }

    public function getDaysToGo() {
        return $this->tonext->format('%a');
    }

}

?>
