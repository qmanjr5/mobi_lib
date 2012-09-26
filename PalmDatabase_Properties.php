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
		$this->name = fread($this->filehandle, 32);
		$this->attributes = fread($this->filehandle, 2);
		$this->version = fread($this->filehandle, 2);
		$this->creation_date = fread($this->filehandle, 4);
		$this->modification_date = fread($this->filehandle, 4);
		$this->last_backup_date = fread($this->filehandle, 4);
		$this->modification_number = fread($this->filehandle, 4);
		$this->appInfoid = fread($this->filehandle, 4);
		$this->sortInfoId = fread($this->filehandle, 4);
		$this->type = fread($this->filehandle, 4);
		$this->creator = fread($this->filehandle, 4);
		$this->uniqueIdSeed = fread($this->filehandle, 4);
		$this->nextRecordlistId = fread($this->filehandle, 4);
	}
}
