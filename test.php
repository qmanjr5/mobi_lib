<?php
include ("PalmDatabase.php");
include ("PalmDatabase_Properties.php");
include ("PalmDatabase_Record.php");
ini_set("Memory_limit","120M");
$test = new PalmDatabase("testbook.mobi");
echo $test->records[3]->data;
