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
	}
}

