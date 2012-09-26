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

	public function __construct($file)
	{
		if(is_string($file))
		{
			$this->filehandle = fopen($file);
		}
		elseif(is_resource($file))
		{
			$this->filehandle = $file;
		}
		else
		{
			return false;
		}

		$this->load();
	}
	public function load();
	{
		//Stuff to come
	
	}
}
