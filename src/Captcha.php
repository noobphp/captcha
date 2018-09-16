<?php
namespace Noob\Captcha;

use Noob\Captcha\Lib\CaptchaCodeGenerator;
use Noob\Captcha\Lib\CaptchaPaint;
use Noob\Captcha\Lib\NoobCaptchaCodeGenerator;
use Noob\Captcha\Lib\NoobCaptchaPaint;

/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:12
 */

class Captcha
{
    protected $paint;
    protected $code_generator;

    public function __construct(CaptchaCodeGenerator $codeGenerator = null, CaptchaPaint $paint = null)
    {
        $this->code_generator = $codeGenerator ?: $this->getCodeGenerate();
        $this->paint = $paint ?: $this->getPaint();
    }

    public function display()
    {
        header('Content-type: image/png');
        echo $this->getPaint()->setRandBgColor()->write($this->getCodeGenerate())->getResource()->destroyImage();
    }

    protected function getPaint()
    {
        if ($this->paint === null) {
            $this->paint = new NoobCaptchaPaint();
        }
        return $this->paint;
    }

    protected function getCodeGenerate()
    {
        if ($this->code_generator === null) {
            $this->code_generator = new NoobCaptchaCodeGenerator();
        }
        return $this->code_generator;
    }

    public function getCode()
    {
        return $this->getCodeGenerate()->getCode();
    }
}