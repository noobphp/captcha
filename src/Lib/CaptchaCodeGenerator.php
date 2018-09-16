<?php
namespace Noob\Captcha\Lib;
/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:36
 */

interface CaptchaCodeGenerator
{
    public function setCode($code);

    public function getCode();

    public function getCodeLength();
}