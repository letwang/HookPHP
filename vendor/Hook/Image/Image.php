<?php
declare(strict_types=1);

namespace Hook\Image;

class Image
{

    public static array $type = [
        1 => 'gif',
        2 => 'jpeg',
        3 => 'png'
    ];

    public static function compress($src, $quality = 90)
    {
        list ($width, $height, $type) = @getimagesize($src);
        if (! is_numeric($type)) {
            return false;
        }
        
        $imagecreatefromFunction = 'imagecreatefrom' . self::$type[$type];
        $imageFunction = 'image' . self::$type[$type];
        $quality = $type !== 2 && $quality > 9 ? 9 : $quality;
        
        if (($img = @$imagecreatefromFunction($src)) && imagecopyresampled($img, $img, 0, 0, 0, 0, $width, $height, $width, $height) && $imageFunction($img, $src, $quality)) {
            return imagedestroy($img);
        }
        is_resource($img) && imagedestroy($img);
        return false;
    }

    public static function watermarkToJpg($fromPath, $watermarkPath, $toPath = '', $xAlign = 'left', $yAlign = 'bottom', $quality = 90)
    {
        $xOffset = $yOffset = $xPos = $yPos = 10; // 偏移10像素
        
        if (! ($img = @imagecreatefromjpeg($fromPath)) || ! (list ($waterWidth, $waterHeight, $waterType) = @getimagesize($watermarkPath))) {
            return false;
        }
        
        $imagecreatefromFunction = 'imagecreatefrom' . self::$type[$waterType];
        if (! ($imgWater = @$imagecreatefromFunction($watermarkPath))) {
            return false;
        }
        
        list ($imgWidth, $imgHeight) = @getimagesize($fromPath);
        if ($xAlign == 'middle') {
            $xPos = $imgWidth / 2 - $waterWidth / 2 + $xOffset;
        }
        if ($xAlign == 'left') {
            $xPos = 0 + $xOffset;
        }
        if ($xAlign == 'right') {
            $xPos = $imgWidth - $waterWidth - $xOffset;
        }
        if ($yAlign == 'middle') {
            $yPos = $imgHeight / 2 - $waterHeight / 2 + $yOffset;
        }
        if ($yAlign == 'top') {
            $yPos = 0 + $yOffset;
        }
        if ($yAlign == 'bottom') {
            $yPos = $imgHeight - $waterHeight - $yOffset;
        }
        
        $cut = imagecreatetruecolor($waterWidth, $waterHeight);
        imagecopy($cut, $img, 0, 0, $xPos, $yPos, $waterWidth, $waterHeight);
        imagecopy($cut, $imgWater, 0, 0, 0, 0, $waterWidth, $waterHeight);
        imagecopymerge($img, $cut, $xPos, $yPos, 0, 0, $waterWidth, $waterHeight, $quality);
        if (imagejpeg($img, ($toPath ? $toPath : $fromPath), $quality)) {
            return imagedestroy($cut) && imagedestroy($img);
        }
        is_resource($cut) && imagedestroy($cut);
        is_resource($img) && imagedestroy($img);
        return false;
    }
}