<?php
namespace Noob\Captcha\Lib;
/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:21
 */

interface CaptchaPaint
{
    public function write(CaptchaCodeGenerator $code_generator);

    public function setBgColor($r, $g, $b);

    public function setHeight($height);

    public function getHeight();

    public function setWidth($width);

    public function getWidth();

    public function getResource();
}