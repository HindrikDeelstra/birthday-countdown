#!/usr/bin/php
<?php

require_once('class.birthday.php');
ini_set('date.timezone', 'Europe/Amsterdam');

include('../../medewerkers.php');

/* The file 'medewerkers.php' contains an array '$people' in the form:
** $people = array(
** 'FirstName1' => 'Birthdate1',
** 'FirstName2' => 'Birthdate2',
** );
**
** This info might also be taken from a Database ofcourse...
*/

// Only consider birthdays coming up in a limited amount of time
$daystolook = 31;

// Create an array to be filled with data, this will be sorted later
$list = array();

// Initialize array id and collect data
$i = 0;
foreach($people as $name=>$date) {
    $bday = new Birthday($date);
    // Skip entries that are more than $daystolook number of days in the future
    if($bday->getDaysToGo() > $daystolook) continue;
    $list[$i]['name'] = $name;
    $list[$i]['next'] = $bday->getNextDate();
    $list[$i]['days'] = $bday->getDaysToGo();
    $list[$i]['age'] = $bday->getAge();
    $i++;
}

// Sort the array by number of days to next birthday
usort($list, 'sortByDays');

// Define function to sort array by number of days left
function sortByDays($a, $b) {
    return $a['days'] - $b['days'];
}

// Print the results
foreach ($list as $birth) {
    switch($birth['days']) {
        case 0:
            print("Vandaag jarig: $birth[name] ($birth[age])".PHP_EOL);
            break;
        case 1:
            print("Morgen jarig: $birth[name] ($birth[age])".PHP_EOL);
            break;
        default:
            print("Over $birth[days] dagen jarig: $birth[name] ($birth[age])".PHP_EOL);
    }
}

?>
