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
