<?php

// We're working with DateTimes, so we'll set the correct timezone first
ini_set('date.timezone', 'Europe/Amsterdam');

// Include the class
require_once('class.birthday.php');

// Get birthdays from file.
// Data-output from 'medewerkers.php' is expected as an array named $people,
// containing First Name as keys, and their birthdate as the values:
// $people = array('FirstName1' => 'birthdate1', 'FirstName2' => 'birthdate2', .. , 'FirstNameN' => 'birthdateN');
include_once('medewerkers.php');

// Dump all birthday data on request
if(isset($_GET['list'])) {
    print('<table width="450"><tr><th align="left">Naam</th>');
    print('<th align="left">Geb.datum</th>');
    print('<th align="left">Verjaardag</th>');
    print('<th align="left">Dagen</th>');
    print('<th align="left">Leeftijd</th></tr>'.PHP_EOL);
    foreach($people as $name=>$date) {
        $bday = new Birthday($date);
        print('<tr><td>'.$name.'</td>');
        print('<td>'.$date.'</td>');
        print('<td>'.$bday->getNextDate().'</td>');
        print('<td>'.$bday->getDaysToGo().'</td>');
        print('<td>'.$bday->getAge().'</td></tr>'.PHP_EOL);
    }
    print('</table>'.PHP_EOL);
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
