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
		
		$attirbutes = fread($this->filehandle, 2);
		$this->attributes = $attributes;
		
		$version = fread($this->filehandle, 2);
		$this->version = unpack("n", $version);
		
		$creation_date = fread($this->filehandle, 4);
		$this->creation_date = unpack("N", $creation_date);

		$modification_date = fread($this->filehandle, 4);
		$this->modification_date = unpack("N", $modification_date);

		$last_backup_date = fread($this->filehandle, 4);
		$this->last_backup_date = unpack("N", $modification_date);

		$modification_number = fread($this->filehandle, 4);
		$this->modification_number = unpack("N", $modification_number);
		
		$appinfoid = fread($this->filehandle, 4);
		$this->appInfoId = unpack("N", $appinfoid);

		$sortinfoid = fread($this->filehandle, 4);
		$this->sortInfoId = unpack("N", $sortinfoid);

		$type = fread($this->filehandle, 4);
		$this->type = $type;

		$creator = fread($this->filehandle, 4);
		$this->creator = $creator;

		$uniqueidseed = fread($this->filehandle, 4);
		$this->uniqueIdSeed = unpack("N", $uniqueidseed);

		$nextrecordlistid = fread($this->filehandle, 4);
		$this->nextRecordListId = unpack("N", $nextrecordlistid);

		$numRecords = unpack("n", fread($this->filehandle, 2));
	
		for($i=0;$i<=$numRecords;$i++)
		{
			$offset = fread($this->filehandle, 4);
			$this->recordInfo["$i"]["offset"] = unpack("N", $offset);
			$attributes = fread($this->filehandle, 1);
			$this->recordInfo["$i"]["attributes"] = $attributes;
			$id = fread($this->filehandle, 3);
			$this->recordInfo["$i"]["id"] = unpack("N","\0{$id}");
		}
	}
}
