<?php
include ("PalmDatabase.php");
include ("PalmDatabase_Properties.php");
include ("PalmDatabase_Records.php");

$test = new PalmDatabase("testbook.mobi");
echo $test->properties;

