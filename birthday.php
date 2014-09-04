<?php

// We're working with DateTimes, so we'll set the correct timezone first
ini_set('date.timezone', 'Europe/Amsterdam');

// Include the class
require_once('class.birthday.php');

// Get birthdays from file.
// Data-output from 'medewerkers.php' is expected as an array named $people,
// containing Names as keys, and their birthdate as their values:
// $people = array('Name1' => 'birthdate1', 'Name2' => 'birthdate2', .. , 'NameN' => 'birthdateN');
include_once('medewerkers.php');

// Dump all birthday data on request
if(isset($_GET['list'])) {
    include('list.birthday.php');
} else {

    // Initialize list, data filled in as array[$DaysToGo] = (List of all names and ages)
    $list = array();

    // Fill the list with data
    foreach($people as $name=>$date) {
        $bday = new Birthday($date);
        @$list[$bday->getDaysToGo()] .= $name.' ('.$bday->getAge().') ';
    }

    // Sort the list by key = number of DaysToGo
    ksort($list);

    // Initialize misc variables
    $showlater = true;

    // If there are any birthdays today or tomorrow, show them, but not any later birthdays
    if(key($list) == 0) {
        print('<div class="flags"></div>'.PHP_EOL); // Show a decorative ribbon of flags
        print('<div class="birthday">Vandaag jarig: '.current($list).'</div>'.PHP_EOL);
        next($list);
        $showlater = false;
    }
    if(key($list) == 1) {
        print('<div class="birthday">Morgen jarig: '.current($list).'</div>'.PHP_EOL);
        next($list);
        $showlater = false;
    }

    // If there are no birthdays today or tomorrow, show just the first one in the list
    if($showlater) {
        print( (current($list) ? '<div class="birthday">Over '.key($list).' dagen jarig: '.current($list).'</div>'.PHP_EOL : '' ) );
    }
}

?>
