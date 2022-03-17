<?php

namespace App\Services;



class ImageManipulatorService
{
    /**
     * For some reason dompdf was having problems rendering .png images (issue image compression) So converted to JPG returing base64
     * @param string $url
     * @return string
     */
    public function createBase64FromUrl(string $url): string
    {
        $tempFile = tmpfile();
        fwrite($tempFile, file_get_contents($url));
        $pathTempFile = stream_get_meta_data($tempFile);
        $tempPath = $pathTempFile['uri'];
        $imagePng = imagecreatefrompng($tempPath);
        $bg = imagecreatetruecolor(imagesx($imagePng), imagesy($imagePng));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $imagePng, 0, 0, 0, 0, imagesx($imagePng), imagesy($imagePng));
        imagedestroy($imagePng);
        imagejpeg($bg, $tempPath . 'jpg', 100);
        imagedestroy($bg);
        $type = pathinfo($tempPath . 'jpg', PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($tempPath . 'jpg'));
    }
}
