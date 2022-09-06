<?php

if(!isset($_GET['text']))
{
	die("No text provided");
}

// Set the content-type
header('Content-type: image/png');
// Create the image
$im = imagecreatetruecolor(420, 110);
 
// Create a few colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

$transparent = imagecolorallocatealpha($im, 255, 255, 255, 127);

//For Transparent Image
imagealphablending($im, false);
imagesavealpha($im, true);
//For Transparent Image

imagefilledrectangle($im, 0, 0, 420, 110, $transparent);
 
// set the text to draw
$text = $_GET['text'];
// set the text size
$size = $_GET['size'];
// Replace path by your own font path
if($_GET['font']=='1')
{
	$font = 'font/Prof. Jorge.ttf';
}
else if($_GET['font']=='2')
{
	$font = 'font/Haikus Script.ttf';
}
else if($_GET['font']=='3')
{
	$font = 'font/HONEY.ttf';
}
else if($_GET['font']=='4')
{
	$font = 'font/VadimsWriting.ttf';
}
else if($_GET['font']=='5')
{
	$font = 'font/Callie_Hand.otf';
}else
{
	$font = 'font/Prof. Jorge.ttf';
}

// Add a shadow to the text
//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
// And add the text
imagettftext($im, $size, 0, 5, 75, $black, $font, $text); // Note :: Image(height*width),font size, right corner text padding, left text padding, upper text padding
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);

?>