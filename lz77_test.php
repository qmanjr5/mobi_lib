<?php
include("lz77.php");

$lz77 = new lz77();
$text = "This is some sample text.";
echo "Text: " . $text . "\n";
$encoded_text = $lz77->compress($text);
echo "Encoded text: " . $encoded_text . "\n";
$decoded_text = $lz77->decompress($encoded_text);
echo "Decoded text: " . $decoded_text . "\n";
