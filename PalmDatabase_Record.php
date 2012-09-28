<?php
class PalmDatabase_Record
{
	public $filehandle;
	public $offset;
	public $attributes;
	public $id;
	public $size;
	public $data;
	public function __construct($file, $info, $size)
	{
		$this->filehandle = $file;
		$this->offset = $info["offset"];
		$this->attributes = $info["attributes"];
		$this->id = $info["id"];
		$this->size = $size;
		$this->load();
	}
	public function load()
	{
		fseek($this->filehandle,$this->offset);
		
		$data = fread($this->filehandle,$this->size);
		$this->data = $data;
	}
}

