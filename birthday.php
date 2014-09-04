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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Hindrik's verjaardagenpagina</title>
<script type="text/javascript" src="js/sortabletable.js"></script>
<link type="text/css" rel="StyleSheet" href="css/sortabletable.css" />
<style type="text/css">
h3      { color: red; }
TABLE   { border-collapse: collapse; border: 1px solid #C0C0C0; }
TD,TH   { border: 1px solid #C0C0C0; padding: 6px; text-align: left; }
</style>
</head>
<body>

<h2>Medewerkers:</h2>
<table class="sort-table" id="table" cellspacing="0">
    <col />
    <col />
    <col />
    <col />
    <col />
    <thead>
        <tr>
            <td>Naam</td>
            <td>Geboortedatum</td>
            <td>Wanneer jarig?</td>
            <td>Over hoeveel dagen?</td>
            <td>Hoe oud dan?</td>
        </tr>
    </thead>
<?php
    foreach($people as $name=>$date) {
        $bday = new Birthday($date);
        print('<tr><td>'.$name.'</td>');
        print('<td>'.$date.'</td>');
        print('<td>'.$bday->getNextDate().'</td>');
        print('<td>'.$bday->getDaysToGo().'</td>');
        print('<td>'.$bday->getAge().'</td></tr>'.PHP_EOL);
    }

?>
</table>
<script type="text/javascript">
var st = new SortableTable(document.getElementById("table"),["String", "Date", "Date", "Number", "Number"]);
</script>
</body>
</html>
<?php
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
