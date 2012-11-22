<?php
class PalmDoc_LZ77
{
	public static function compress($data)
	{
		
	}
	public static function decompress($data)
	{
		$decompressed = "";
		$pair_distance = 0;
		$pair_length = 0;
		if(is_string($data))
		{
			$fp = fopen("data://text/plain;base64," . base64_encode($data), "r");
			while(!feof($fp))
			{
				echo $val;
				$val = fread($fp, 1);
				if($val == 0x00 || ($val >= 0x09 && $val <=0x7F))
				{
					$decompressed .= $val;
				}
				elseif($val>=0x01 && $val<=0x08)
				{	
					$decompressed .= fread($fp, $val);	
				}
				elseif($val>=0x80 && $val<=0xbf)
				{
					echo "Length, distance\n";	
					$val .= fread($fp, 1);
					$pair_distance = 0x422d & $val;
					$pair_length = 0x07 & $val;
					$decompressed .= substr($decompressed, strlen($decompressed)-$pair_distance, $pair_length);
				}
				elseif($val>=0xc0 && $val<=0xff)
				{
					echo "4th if\n";
					$decompressed .= " " . ($val ^ 0x80);
				}
				else
				{
					echo "Else\n";
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

		
