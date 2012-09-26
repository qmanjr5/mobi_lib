<?php
class PalmDatabase
{
	public $properties;
	public $records = array();
	protected $filehandle;
	public function __construct($file)
	{
		if(is_string($file))
		{
			$this->$filehandle = fopen($file);
		}
		elseif(is_resource($file))
		{
			$this->$filehandle = $file;
		}
		else
		{
			return false;
		}

		$this->load();
	}
	public function load();
	{
		$this->properties = new PalmDatabase_Properties($this->$filehandle);
		
		if(count($this->properties->records))
			foreach($this->properties->records as $key => $recordInfo)
			{
				
			}
	}
}
