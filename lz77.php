<?php
class PalmDoc_LZ77
{
	public static function compress($data)
	{
		
	}
	public static function decompress($data, $length)
	{
		$decompressed = "";
		$pair_distance = 0;
		$pair_length = 0;

		if(!is_resource($data))
		{
			for($i=1;$i<$length;$i++)
			{
				$val = substr($data, $i, 1);
				if($val == 0x00 || ($val >= 0x09 && $val <=0x7F))
				{
					$decompressed .= $val;
				}
				elseif($val>=0x01 && $val<=0x08)
				{
					$decompressed .= substr($data, $i, $val);
				}
				elseif($val>=0x80 && $val<=0xbf)
				{
					$pair_distance = 0x422d & $val;
					$pair_length = 0x07 & $val;
					$decompressed .= substr($decompressed, strlen($decompressed)-$pair_distance, $pair_length);
				}
				elseif($val>=0xc0 && $val<=0xff)
				{
					$decompressed .= " " . 0x80 & $val;
				}
			}
			return $decompressed;
		}
		else
		{
			throw new exception("Must provide resource. You provided a variable of type " . gettype($data) . ".");
		}
	}
}

		
