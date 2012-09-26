<?php
class PalmDatabase_Properties
{
	protected $filehandle;
	public $name;
	public $attributes;
	public $version;
	public $creation_date;
	public $modification_date;
	public $last_backup_date;
	public $modification_number;
	public $appInfoId;
	public $sortInfoId;
	public $type;
	public $creator;
	public $uniqueIdSeed;
	public $nextRecordListId;
	public $recordInfo;

	public function __construct($file)
	{
		echo "File: " . $file;
	 	$this->filehandle = $file;	
		$this->load();	
	}
	public function load()
	{
		$name = fopen($this->filehandle, 32);
		$this->name = unpack("a",$name);
	}
}
