<?php

@require_once('class.birthday.php');
ini_set('date.timezone', 'Europe/Amsterdam');

// Initialize $people just in case the file include fails
$people = array();
@include('medewerkers.php');
@include(__DIR__.'/../../medewerkers.php');

// Initialize array, data filled in as array[$DaysToGo] = (List of all names and ages)
$list = array();

// Fill the array with data
foreach($people as $name=>$date) {
    $bday = new Birthday($date);
    @$list[$bday->getDaysToGo()] .= $name.' ('.$bday->getAge().') ';
}

// Sort the array by key = number of DaysToGo
ksort($list);

// Initialize a few other settings
$showlater = true;

// When birthdays are today or tomorrow, skip listing any later birthdays
if(key($list) == 0) {
    print('<div class="flags"></div>'.PHP_EOL);
    print('<div class="birthday">Vandaag jarig: '.current($list).'</div>'.PHP_EOL);
    next($list);
    $showlater = false;
}
if(key($list) == 1) {
    print('<div class="birthday">Morgen jarig: '.current($list).'</div>'.PHP_EOL);
    next($list);
    $showlater = false;
}

// If there are no birthdays today or tomorrow, print just the next occurrence
if($showlater) {
    print( (current($list) ? '<div class="birthday">Over '.key($list).' dagen jarig: '.current($list).'</div>'.PHP_EOL : '' ) );
}

?>
