<?php

// Set the content-type

// Create the image
$im = imagecreatetruecolor(400, 60);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 59, $white);

// The text to draw
$text = 'Simple Example Text ' . date("d/m/Y");
// Replace path by your own font path
$font = 'Ubuntu-Regular.ttf';

// Add some shadow to the text
imagettftext($im, 18, 0, 11, 41, $grey, $font, $text);

// Add the text
imagettftext($im, 18, 0, 10, 40, $black, $font, $text);

header('Content-Type: image/png');
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>