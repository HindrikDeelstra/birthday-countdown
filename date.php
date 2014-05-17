#!/usr/bin/php
<?php

require_once('class.birthday.php');
ini_set('date.timezone', 'Europe/Amsterdam');

include('../../medewerkers.php');

$daystolook = 31;
$list = array();
$i = 0;
foreach($people as $name=>$date) {
    $bday = new Birthday($date);
    if($bday->getDaysToGo() > $daystolook) continue;
    $list[$i]['name'] = $name;
    $list[$i]['next'] = $bday->getNextDate();
    $list[$i]['days'] = $bday->getDaysToGo();
    $list[$i]['istoday'] = $bday->isToday();
    $list[$i]['age'] = $bday->getAge();
    $i++;
}

usort($list, 'sortByDays');

function sortByDays($a, $b) {
    return $a['days'] - $b['days'];
}

foreach ($list as $birth) {
    if($birth['istoday']){
        print("Vandaag jarig: $birth[name] ($birth[age])".PHP_EOL);
    } else {
        print("Over $birth[days] dagen jarig: $birth[name] ($birth[age])".PHP_EOL);
    }
}

?>
