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
	 	$this->filehandle = $file;	
		$this->load();	
	}
	public function load()
	{
		$name = fread($this->filehandle, 32);
		$this->name = $name;
		
		$attributes = fread($this->filehandle, 2);
		$this->attributes = new PalmDatabase_Attributes($attributes);
		
		$version = unpack("n", fread($this->filehandle, 2));
		$this->version = $version["1"];
		
		$creation_date = unpack("N", fread($this->filehandle, 4));
		$this->creation_date = $creation_date["1"];

		$modification_date = unpack("N", fread($this->filehandle, 4));
		$this->modification_date = $modification_date["1"];

		$last_backup_date = unpack("N", fread($this->filehandle, 4));
		$this->last_backup_date = $last_backup_date["1"];

		$modification_number = unpack("N", fread($this->filehandle, 4));
		$this->modification_number = $modification_number["1"];
		
		$appinfoid = unpack("N", fread($this->filehandle, 4));
		$this->appInfoId = $appinfoid["1"];

		$sortinfoid = unpack("N", fread($this->filehandle, 4));
		$this->sortInfoId = $sortinfoid["1"];

		$type = fread($this->filehandle, 4);
		$this->type = $type;

		$creator = fread($this->filehandle, 4);
		$this->creator = $creator;

		$uniqueidseed = unpack("N", fread($this->filehandle, 4));
		$this->uniqueIdSeed = $uniqueidseed["1"];

		$nextrecordlistid = unpack("N", fread($this->filehandle, 4));
		$this->nextRecordListId = $nextrecordlistid["1"];

		list(,$numRecords) = unpack("n", fread($this->filehandle, 2));	
		for($i=0;$i>=$numRecords;$i++)
		{
			$offset = fread($this->filehandle, 4);
			list(,$this->recordInfo["$i"]["offset"]) = unpack("N", $offset);
			$attributes = fread($this->filehandle, 1);
			$this->recordInfo["$i"]["attributes"] = new PalmDatabase_RecordAttributes($attributes);
			$id = fread($this->filehandle, 3);
			list(,$this->recordInfo["$i"]["id"]) = unpack("I","{$id}\0");
		}
	}
}
