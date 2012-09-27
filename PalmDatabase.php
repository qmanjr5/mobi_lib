<?php
class PalmDatabase
{
	public $properties;
	public $records;
	public $filehandle;
	public function __construct($file)
	{
		if(is_string($file))
		{
			$this->filehandle = fopen($file,"r");
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
	public function load()
	{
		$this->properties = new PalmDatabase_Properties($this->filehandle);
		$this->records = new PalmDatabase_Records($this->filehandle);
	}
}
