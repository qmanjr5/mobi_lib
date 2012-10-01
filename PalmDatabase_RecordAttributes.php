<?php
class PalmDatabase_RecordAttributes
{
	public $attributes;
	public $secret_record = "false";
	public $record_busy = "false";
	public $dirty_record = "false";
	public $delete_record = "false";

	public function __construct($attributes)
	{
		$this->attributes = $attributes;
		$this->load();
	}
	public function load()
	{
		if($this->attributes & 0x10)
		{
			$this->secret_record = "true";
		}
		if($this->attributes & 0x20)
		{
			$this->record_busy = "true";
		}
		if($this->attributes & 0x40)
		{
			$this->dirty_record = "true";
		}
		if($this->attributes & 0x80)
		{
			$this->delete_record = "true";
		}
	}
}
