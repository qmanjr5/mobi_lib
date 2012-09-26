<?php
include ("PalmDatabase.php");
include ("PalmDatabase_Properties.php");

$test = new PalmDatabase("testbook.mobi");
echo $test->properties->name;
