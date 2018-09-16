<?php
namespace Noob\Captcha\Lib;
/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:42
 */

class NoobCaptchaPaint implements CaptchaPaint
{
    protected $image;
    protected $width;
    protected $height;
    protected $font_file;

    public function __construct($width = 160, $height = 60)
    {
        $this->width = $width;
        $this->height= $height;
    }

    public function write(CaptchaCodeGenerator $code_generator)
    {
        // TODO: Implement write() method.
        $code_length = $code_generator->getCodeLength();
        $middle_index = ($code_length - 1) / 2;
        $font_size = $code_length < 4 ? 20 : $this->width / ($code_length * 2);
        $y = $this->height / 1.5;
        for ($i = 0; $i < $code_length; $i++) {
            $x = $this->width / 2 + ($i - $middle_index) * $font_size * 2 - $font_size / 2;
            imagettftext($this->getImage(), $font_size, mt_rand(-20, 20), $x, $y, $this->getColor(mt_rand(20, 150), mt_rand(20, 150) , mt_rand(20, 150)), $this->getFontFile(), $code_generator->getCode()[$i]);
        }
        return $this;
    }

    public function getResource()
    {
        // TODO: Implement getResource() method.
        imagepng($this->getImage());
        return $this;
    }

    public function setBgColor($r, $g, $b)
    {
        // TODO: Implement setBgColor() method.
        imagefill($this->getImage(), 0, 0, $this->getColor($r, $g, $b));
        return $this;
    }

    public function setRandBgColor($min = 200, $max = 255)
    {
        return $this->setBgColor(mt_rand($min, $max), mt_rand($min, $max), mt_rand($min, $max));
    }

    public function getHeight()
    {
        // TODO: Implement getHeight() method.
        return $this->height;
    }

    public function setHeight($height)
    {
        // TODO: Implement setHeight() method.
        $this->height = $height;
        return $this;
    }

    public function getWidth()
    {
        // TODO: Implement getWidth() method.
        return $this->width;
    }

    public function setWidth($width)
    {
        // TODO: Implement setWidth() method.
        $this->width = $width;
        return $this;
    }

    protected function getFontFile()
    {
        if ($this->font_file === null) {
            $this->font_file = __DIR__.'/../font/PIXEAB__.TTF';
        }
        return $this->font_file;
    }

    /**
     * @param mixed $font_file
     */
    public function setFontFile($font_file)
    {
        $this->font_file = $font_file;
        return $this;
    }

    /**
     * @return resource
     */
    protected function getImage()
    {
        if ($this->image === null) {
            $this->image = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        }
        return $this->image;
    }

    protected function getColor($r, $g, $b)
    {
        return imagecolorallocate($this->getImage(), $r, $g, $b);
    }

    public function destroyImage()
    {
        return imagedestroy($this->getImage());
    }
}