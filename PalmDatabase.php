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
	
		if(count($this->properties->recordInfo)) 
		{
			$recordInfo = reset($this->properties->recordInfo);
			do 
			{
				$start = $recordInfo["offset"];
				if($next = next($this->properties->recordInfo)) 
				{
					prev($this->properties->recordInfo);
					$end = $next["offset"];
				} 
				else 
				{
					$stat = fstat($this->filehandle);
					$end = $stat["size"];
				}
				$size = $end - $start;
				if($size<0)
				{
					continue;
				}
				$this->records[] = new PalmDatabase_Record($this->filehandle, $recordInfo, $size);
			} 
			while($recordInfo = next($this->properties->recordInfo));
		}
		echo count($this->records);
	}
}
