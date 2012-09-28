<?php
include ("PalmDatabase.php");
include ("PalmDatabase_Properties.php");
include ("PalmDatabase_Record.php");
$test = new PalmDatabase("testbook.mobi");
echo "Database name: " . $test->properties->name;
echo "Database records: " . count($test->records);
