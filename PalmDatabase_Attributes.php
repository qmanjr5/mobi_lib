<?php
class PalmDatabase_Attributes
{
	public $filehandle;
	public $readonly = false;
	public $dirtyAppInfoArea = false;
	public $backup = false;
	public $install_newer = false;
	public $force_reset = false;
	public $no_beaming = false;

	public function __construct($file);
	{
		$this->filehandle = $file;
		$this->load();
	}
	public function load()
	{
		fseek($this->filehandle, 32);
		$attributes = fread($this->filehandle, 2);
		if($attributes & 0x0002)
		{
			$this->readonly = true;
		}
		if($attributes & 0x0004)
		{
			$this->dirtAppInfoArea = true;
		}
		if($attributes & 0x0008)
		{
			$this->backup = true;
		}
		if($attributes & 0x0010)
		{
			$this->install_newew = true;
		}
		if($attributes & 0x0020)
		{
			$this->force_reset = true;
		}
		if($attributes & 0x0040)
		{
			$this->no_beaming = true;
		}
	}
}

