<?php
class PalmDatabase_Records
{
	protected $filehandle;
	public $records = array();
	
	public function __construct($file)
	{
		$this->filehandle = $file;
		$this->load();
	}
	public function load()
	{
		fseek($this->filehandle, 76); 
		$numberOfRecords = unpack("n",fread($this->filehandle, 2));
		fseek($this->filehandle, 78);
		for($i=0; $i<=$numberOfRecords; $i++);
		{
			$current_pos = 78 + (8*$i);
			$record_pos = unpack("N",fread($this->filehandle, 4));
			fseek($this->filehandle, $current_pos+8);
			$record_end = unpack("N",fread($this->filehandle, 4));	
			$record_length = $record_end-$record_pos;

			fseek($this->filehandle, $current_pos);
			$record_attribs = fread($this->filehandle, 1);
			$record_id = fread($this->filehandle, 3);
			$this->records[$i][attributes] = $record_attribs;
			$this->records[$i][id] = $record_id;
			
			fseek($this->filehandle, $record_pos);
			$this->records[$i][data] = fread($this->filehandle, $record_length);
		}
	}
}

