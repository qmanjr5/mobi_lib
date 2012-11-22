<?php
class mobi extends PalmDatabase
{
	public $compression;
	public $unused;
	public $text_length;
	public $record_count;
	public $record_size;
	public $current_position;
	public $encryption_type;
	public $unknown;
	public $identifier;
	public $header_length;
	public $mobi_type;
	public $text_encoding;
	public $unique_id;
	public $file_version;
	public $ortographic_index;
	public $inflection_index;
	public $index_names;
	public $index_keys;
	public $extra_index_0;
	public $extra_index_1;
	public $extra_index_2;
	public $extra_index_3;
	public $extra_index_4;
	public $extra_index_5;
	public $non_book_index;
	public $full_name_offset;
	public $full_name_length;
	public $locale;
	public $input_language;
	public $output_language;
	public $min_version;
	public $first_image_index;
	public $huffman_record_offset;
	public $huffman_record_count;
	public $exth_flags;
	public $unknown_2;
	public $drm_offset;
	public $drm_count;
	public $drm_size;
	public $drm_flags;
	public $unknown_3;
	public $first_content_record;
	public $last_content_record;
	public $unknown_4;
	public $fcis_record_number;
	public $unknown_5;
	public $fcis_record_number_2;
	public $unknown_6;
	public $unknown_7;
	public $unknown_8;
	public $unknown_9;
	public $unknown_10;
	public $unknown_11;
	public $extra_record_data_flags;
	public $indx_record_offset;
	public $exth_identifier;
	public $exth_length;
	public $exth_numRecords;
	public $exth_records = array();
	public $exth_padding;
	public $index_identifier;
	public $index_header_length;
	public $index_type;
	public $indxt_offset;
	public $index_count;
	public $index_encoding;
	public $index_language;
	public $total_index_count;
	public $ordt_start;
	public $ligt_start;
	public $filehandle;
	
	public function __construct($file)
	{
		parent::__construct($file);	
	}
	public function load()
	{
		parent::load();
		foreach($this->records as $record)
		{
			fseek($this->filehandle, $record->offset);

			$recordData = fread($this->filehandle, $record->size);
			$record->data = PalmDoc_LZ77::decompress($recordData);

		}
		fseek($this->filehandle, $this->records[0]->offset);
		
		$compression = fread($this->filehandle, 2);
		list(,$this->compression) = unpack("n", $compression);
		fread($this->filehandle, 2);
		
		$text_length = fread($this->filehandle, 4);
		list(,$this->text_length) = unpack("N", $text_length);
		
		$record_length = fread($this->filehandle, 2);
		list(,$this->text_length) = unpack("n", $text_length);

		$record_count = fread($this->filehandle, 2);
		list(,$this->record_count) = unpack("n", $record_count);

		$record_size = fread($this->filehandle, 2);
		list(,$this->record_size) = unpack("n", $record_size);

		$current_position = fread($this->filehandle, 4);
		list(,$this->current_position) = unpack("N", $current_position);

		$encryption_type = fread($this->filehandle, 2);
		list(,$this->encryption_type) = unpack("n", $encryption_type);

		fread($this->filehandle, 2);

		$identifier = fread($this->filehandle, 4);
		list(,$this->identifier) = unpack("N", $identifier);
		
		$header_length = fread($this->filehandle, 4);
		list(,$this->header_length) = unpack("N", $header_length);
		
		$remaining = $this->records[0]->size;
		$remaining -= 4;

		$this->checkAndRead($this->mobi_type, 4, $remaining, "N");
		$this->checkAndRead($this->text_encoding, 4, $remaining, "N");
		echo $this->text_encoding . "\n";
		$this->checkAndRead($this->unique_id, 4, $remaining, "N");
		$this->checkAndRead($this->file_version, 4, $remaining, "N");
		$this->checkAndRead($this->ortographic_index, 4, $remaining, "N");
		$this->checkAndRead($this->inflection_index, 4, $remaining, "N");
		$this->checkAndRead($this->index_names, 4, $remaining, "N");
		$this->checkAndRead($this->index_Keys, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_0, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_1, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_2, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_3, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_4, 4, $remaining, "N");
		$this->checkAndRead($this->extra_index_5, 4, $remaining, "N");
		$this->checkAndRead($this->non_book_index, 4, $remaining, "N");
		$this->checkAndRead($this->full_name_offset, 4, $remaining, "N");
		$this->checkAndRead($this->full_name_length, 4, $remaining, "N");
		$this->checkAndRead($this->locale, 4, $remaining, "N");
		$this->checkAndRead($this->input_language, 4, $remaining, "N");
		$this->checkAndRead($this->output_language, 4, $remaining, "N");
		$this->checkAndRead($this->min_version, 4, $remaining, "N");
		$this->checkAndRead($this->first_image_index, 4, $remaining, "N");
		$this->checkAndRead($this->huffman_record_offset, 4, $remaining, "N");
		$this->checkAndRead($this->huffman_record_count, 4, $remaining, "N");
		$this->checkAndRead($this->exth_flags, 4, $remaining, "N");
		fread($this->filehandle, 32);
		$this->checkAndRead($this->drm_offset, 4, $remaining, "N");
		$this->checkAndRead($this->drm_count, 4, $remaining, "N");
		$this->checkAndRead($this->drm_size, 4, $remaining, "N");
		$this->checkAndRead($this->drm_flags, 4, $remaining, "N");
		fread($this->filehandle, 12);
		$this->checkAndRead($this->first_content_record, 2, $remaining, "n");
		$this->checkAndRead($this->last_content_record, 2, $remaining, "n");
		fread($this->filehandle, 4);
		$this->checkAndRead($this->fcis_record_number, 4, $remaining, "N");
		fread($this->filehandle, 4);
		$this->checkAndRead($this->fcis_record_number_2, 4, $remaining, "N");
		fread($this->filehandle, 4);
		fread($this->filehandle, 8);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		$this->checkAndRead($this->extra_record_data_flags, 4, $remaining, "N");
		$this->checkAndRead($this->indx_record_offset, 4, $remaining, "N");
		if($this->exth_flags & 0x40)
		{
			$this->checkAndRead($this->exth_identifier, 4, $remaining, "N");
			$this->checkAndRead($this->exth_length, 4, $remaining, "N");
			$this->checkAndRead($this->exth_numRecords, 4, $remaining, "N");
			for($i=1;$i<=$this->exth_numRecords;$i++)
			{
				$this->checkAndRead($this->exth_records[$i]["record_type"], 4, $remaining, "N");
				$this->checkAndRead($this->exth_records[$i]["record_length"], 4, $remaining, "N");
				$length = $this->exth_records[$i]["record_length"] - 8;
				$tihs->checkAndRead($this->exth_records[$i]["data"], $length, $remaining);
			}
			fread($this->filehandle, $remaining%4);
		}	
		if(!($this->indx_record_offset & 0xFFFFFFFF))
		{
			fseek($this->filehandle, $this->indx_record_offset);
			$this->checkAndRead($this->index_identifier, 4, "N");
			$this->checkAndRead($this->index_header_length, 4);
			$this->checkAndRead($this->index_type, 4);
			fread($this->filehandle, 8);
		 	$this->checkAndRead($this->idxt_start, 4);
			$this->checkAndRead($this->index_count, 4);
			$this->checkAndRead($this->index_encoding, 4);
			$this->checkAndRead($this->index_language, 4);
			$this->checkAndRead($this->total_index_count, 4);
			$this->checkAndRead($this->ordt_start, 4);
			$this->checkAndRead($this->ligt_start, 4);	
		}
		foreach($this->records as $record)
		{
			
		}
	}
	public function checkAndRead(&$field, $length, &$remaining, $unpack = null)
	{
		if(!$remaining)
		{
			return;
		}
		$field = fread($this->filehandle, $length);
		if($unpack)
		{
			list(,$field) = unpack($unpack, $field);
		}
		$remaining -= $length;
		return $field;
	}
}
