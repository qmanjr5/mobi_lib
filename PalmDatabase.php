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
	$this->recordInfo = new PalmDatabase_Records($this->filehandle);
	if(count($this->properties->recordInfo)) {
	$recordInfo = reset($this->properties->recordInfo);
	do {
		$start = $recordInfo->offset;
		if($next = next($this->properties->recordInfo)) {
			prev($this->properties->recordInfo);
			$end = $next->offset;
		} else {
			$stat = fstat($this->fileHandle);
			$end = $stat["size"];
		}
		$size = $end - $start;
		
		$this->records[] = new PalmDatabase_Record($this->filehandle, $recordInfo, $size);
	} while($recordInfo = next($this->properties->recordInfo));
}
	}
}
