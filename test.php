<?php
include ("PalmDatabase.php");
include ("PalmDatabase_Properties.php");
include ("PalmDatabase_Record.php");
include ("PalmDatabase_Attributes.php");
include ("PalmDatabase_RecordAttributes.php");
include ("Mobi.php");
$test = new Mobi("testbook.mobi");
echo "Database name: " . $test->properties->name . "\n";
echo "Database records: " . count($test->records) . "\n";
echo "Attributes" . "\n";
echo "  Read-only: " . $test->properties->attributes->readonly . "\n";
echo "  Dirty Appinfo Area: " . $test->properties->attributes->dirtyAppInfoArea . "\n";
echo "  Backup: " . $test->properties->attributes->backup . "\n";
echo "  Install new version: " . $test->properties->attributes->install_newer . "\n";
echo "  Force reset: " . $test->properties->attributes->force_reset . "\n";
echo "  No beaming: " . $test->properties->attributes->no_beaming . "\n";
echo "Record attributes \n";
$secret_records = 0;
$busy_records = 0;
$dirty_records = 0;
$deleted_records = 0;
var_dump($test->records);
foreach($test->records as $record)
{
	if($record->attributes->secret_bit)
	{
		$secret_records++;
	}
	if($record->attributes->record_busy)
	{
		$busy_records++;
	}
	if($record->attributes->record_dirty)
	{
		$dirty_records++;
	}
	if($record->attributes->delete_record)
	{
		$deleted_records++;
	}
}
echo "  Secret records: " . $secret_records . "\n";
echo "  Busy records: " . $busy_records . "\n";
echo "  Dirty records: " . $dirty_records . "\n";
echo "  Records to be deleted: " . $deleted_records . "\n";
echo "Compression type: " . $test->compress . "\n";
echo "Header length: " . $test->header_length . "\n";
echo "Header length % 4: " . $test->header_length % 4 . "\n";
