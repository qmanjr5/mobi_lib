<?php
class PalmDatabase_Attributes
{
	public $attributes;
	public $readonly = "false";
	public $dirtyAppInfoArea = "false";
	public $backup = "false";
	public $install_newer = "false";
	public $force_reset = "false";
	public $no_beaming = "false";

	public function __construct($attributes)
	{
		$this->attributes = unpack("n",$attributes);
		$this->load();
	}
	public function load()
	{
		if($this->attributes & 0x0002)
		{
			$this->readonly = "true";
		}
		if($this->attributes & 0x0004)
		{
			$this->dirtyAppInfoArea = "true";
		}
		if($this->attributes & 0x0008)
		{
			$this->backup = "true";
		}
		if($this->attributes & 0x0010)
		{
			$this->install_newew = "true";
		}
		if($this->attributes & 0x0020)
		{
			$this->force_reset = "true";
		}
		if($this->attributes & 0x0040)
		{
			$this->no_beaming = "true";
		}
	}
}

