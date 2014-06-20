#!/usr/bin/php
<?php

require_once('class.birthday.php');
ini_set('date.timezone', 'Europe/Amsterdam');

include(__DIR__.'/'.'../../medewerkers.php');

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

foreach($people as $name=>$date) {
    $bday = new Birthday($date);
    @$list[$bday->getDaysToGo()] .= $name.'('.$bday->getAge().') ';
}

ksort($list);

$showlater = true;
$slingers = false;

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

if($showlater) {
    print( (current($list) ? 'Over '.key($list).' dagen jarig: '.current($list) : '' ) );
}

print PHP_EOL;

?>
