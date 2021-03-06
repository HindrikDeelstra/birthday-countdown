<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Verjaardagenpagina</title>
<script type="text/javascript" src="js/sortabletable.js"></script>
<link type="text/css" rel="StyleSheet" href="css/sortabletable.css" />
<style type="text/css">
h3      { color: red; }
TABLE   { border-collapse: collapse; border: 1px solid #C0C0C0; }
TD,TH   { border: 1px solid #C0C0C0; padding: 6px; text-align: right; }
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
            <td>geboren op</td>
            <td>wordt op</td>
            <td>over .. dagen</td>
            <td>.. jaar!</td>
        </tr>
    </thead>
<?php
    foreach($people as $name=>$data) {
        #$bday = new Birthday($date);
        print('<tr><td>'.$name.'</td>');
        print('<td>'.$data['geboortedatum'].'</td>');
        print('<td>'.$data['verjaardag'].'</td>');
        print('<td>'.$data['dagentegaan'].'</td>');
        print('<td>'.$data['leeftijd'].'</td></tr>'.PHP_EOL);
    }

?>
</table>
<script type="text/javascript">
var st = new SortableTable(document.getElementById("table"),["String", "Date", "Date", "Number", "Number"]);
</script>
</body>
</html>
