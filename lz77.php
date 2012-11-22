<?php
class PalmDoc_LZ77
{
	public static function compress($data)
	{
		
	}
	public static function decompress($data)
	{
		$decompressed = "";
		$offset = 0;
		$length = strlen($data);
		if(is_string($data))
		{
			while($offset < $length)
			{
				$literal = substr($data, $offset++, 1);
				$val = ord($literal);

				if($val == 0x00)
				{
					$decompressed .= $literal;
				}
				elseif($val <= 0x08)
				{	
					$decompressed .= substr($data, $offset, $val);
					$offset += $val;	
				}
				elseif($val <= 0x7F)
				{
					$decompressed .= $literal;
				}
				elseif($val <= 0xBF)
				{
					$offset++;
					list(,$val) = unpack('n', substr($data, $offset-2, 2));
					$val &= 0x3fff;
					$pair_length = ($val & 0x0007) + 3;
					$pair_distance = $val >> 3;
					
					$textLength = strlen($decompressed);
					for($i = 0; $i < $pair_length; $i++) {
						$decompressed .= substr($decompressed, $textLength-$pair_distance, 1);
						$textLength++;
					}
				}
				elseif($val <= 0xFF)
				{
					$decompressed .= " " . chr($val ^ 0x80);
				}
			}
			
			return $decompressed;
		}
		else
		{
			throw new exception("You must provide a string. You provided a variable of type " . gettype($data) . ".");
		}
	}
}