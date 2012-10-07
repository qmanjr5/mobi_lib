<?php
class mobi extends PalmDatabase
{
	public $compress;
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
	public $filehandle;
	
	public function __construct($file)
	{
		$this-filehandle = $file;	
		$this->load();
	}
	public function load()
	{
		
		$compression = fread($this->filehandle, 2);
		$this->compression = unpack("n", $compression);
		
		fread($this->filehandle, 2);
		
		$text_length = fread($this->filehandle, 4);
		$this->text_length = unpack("N", $text_length);
		
		$record_length = fread($this->filehandle, 2);
		$this->text_length = unpack("n", $text_length);

		$record_count = fread($this->filehandle, 2);
		$this->record_count = unpack("n", $record_count);

		$record_size = fread($this->filehandle, 2);
		$this->record_size = unpack("n", $record_size);

		$current_position = fread($this->filehandle, 4);
		$this->current_position = unpack("N", $current_position);

		$encryption_type = fread($this->filehandle, 2);
		$this->encryption_type = unpack("n", $encryption_type);

		$unknown = fread($this->filehandle, 2);
		$this->unknown = unpack("n", $unknown);

		$identifier = fread($this->filehandle, 4);
		$this->identifier = unpack("N", $identifier);

		$remaining = unpack("N",fread($this->filehandle, 4)) - 4;

		$this->checkAndRead($this->mobi_type, 4, $remaining, "N");
		$this->checkAndRead($this->text_encoding, 4, $remaining, "N");
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
		$this->checkAndRead($this->drm_offset, 4, "N");
		$this->checkAndRead($this->drm_count, 4, "N");
		$this->checkAndRead($this->drm_size, 4, "N");
		$this->checkAndRead($this->drm_flags, 4, "N");
		fread($this->filehandle, 12);
		$this->checkAndRead($this->first_content_record, 2, "n");
		$this->checkAndRead($this->last_content_record, 2, "n");
		fread($this->filehandle, 4);
		$this->checkAndRead($this->fcis_record_number, 4, "N");
		fread($this->filehandle, 4);
		$this->checkAndRead($this->fcis_record_number_2, 4, "N");
		fread($this->filehandle, 4);
		fread($this->filehandle, 8);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		fread($this->filehandle, 4);
		$this->checkAndRead($this->extra_record_data_flags, 4, "N");
		$this->checkAndRead($this->indx_record_offset, 4, "N");
		if($this->

	}
	public function checkAndRead(&$field, $length, &$remaining, $unpack = null)
	{
		if(!remaining)
		{
			return;
		}
		$field = fread($this->filehandle, $length);
		if($unpack)
		{
			$field = unpack($field, $unpack);
		}
		$remaining -= $length;
	}

