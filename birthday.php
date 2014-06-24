#!/usr/bin/php
<?php

require_once('class.birthday.php');
ini_set('date.timezone', 'Europe/Amsterdam');

include(__DIR__.'/../../medewerkers.php');

/* The file 'medewerkers.php' contains an array '$people' in the form:
** $people = array(
** 'FirstName1' => 'Birthdate1',
** 'FirstName2' => 'Birthdate2',
** );
**
** This info might also be taken from a Database ofcourse...
*/

// Initialize array, data filled in as array[$DaysToGo] = (List of all names and ages)
$list = array();

// Fill the array with data
foreach($people as $name=>$date) {
    $bday = new Birthday($date);
    @$list[$bday->getDaysToGo()] .= $name.'('.$bday->getAge().') ';
}

// Sort the array by key = number of DaysToGo
ksort($list);

// Initialize a few other settings
$showlater = true;
$slingers = false;

// When birthdays are today or tomorrow, skip listing any later birthdays
if(key($list) == '0') {
    print("Vandaag jarig: ");
    print(current($list));
    next($list);
    $showlater = false;
    $slingers = true;
}
if(key($list) == '1') {
    print("Morgen jarig: ");
    print(current($list));
    next($list);
    $showlater = false;
}

// If there are no birthdays today or tomorrow, print just the next occurrence
if($showlater) {
    print( (current($list) ? 'Over '.key($list).' dagen jarig: '.current($list) : '' ) );
}

// When outputting to console, start a newline
print PHP_EOL;

?>
