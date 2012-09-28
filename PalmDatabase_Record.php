<?php
class PalmDatabase_Record
{
	public $filehandle;
	public $info;
	public $size;
	public $data;
	public function __construct($file, $info, $size)
	{
		$this->filehandle = $file;
		$this->info = $info;
		$this->size = $size;
		$this->load();
	}
	public function load()
	{
		fseek($this->filehandle,$this->info["offset"]);
		
		$data = fread($this->filehandle, $this->size);
		$this->data = $data;
	}
}

