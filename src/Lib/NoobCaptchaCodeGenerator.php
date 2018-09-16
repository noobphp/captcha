<?php
namespace Noob\Captcha\Lib;
/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:38
 */

class NoobCaptchaCodeGenerator implements CaptchaCodeGenerator
{
    const NUM = 1;
    const ALP = 2;
    const NUM_ALP = 3;
    const ALP_UP_LO = 50;
    const ALP_UPPER = 51;
    const ALP_LOWER = 52;
    protected $mode;
    protected $alpha_mode = self::ALP_UP_LO;
    protected $code;
    protected $length;

    public function __construct($length = 4, $mode = self::NUM_ALP)
    {
        $this->mode = $mode;
        $this->length = $length;
    }

    public function getCode()
    {
        // TODO: Implement getCode() method.
        if ($this->code === null) {
            for ($i = 0; $i < $this->length; $i++) {
                if ($this->mode === self::NUM) {
                    $this->code .= $this->getRandNum();
                } elseif ($this->mode === self::ALP) {
                    $this->code .= $this->getRandAlphabet();
                } else {
                    $this->code .= mt_rand(0, 1) ? $this->getRandNum() : $this->getRandAlphabet();
                }
            }
        }
        return $this->code;
    }

    public function setCode($code)
    {
        // TODO: Implement setCode() method.
        if (is_array($code)) {
            $this->code = implode('', $code);
        } elseif (is_string($code)) {
            $this->code = $code;
        }
        $this->length = strlen($this->code);
        return $this;
    }

    public function getCodeLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $alpha_mode
     */
    public function setAlphaMode($alpha_mode)
    {
        $this->alpha_mode = $alpha_mode;
        return $this;
    }

    protected function getRandAlphabet()
    {
        if ($this->alpha_mode === self::ALP_UPPER) {
            $code = $this->getRandAlphaUpper();
        } elseif ($this->alpha_mode === self::ALP_LOWER) {
            $code = $this->getRandAlphabetLower();
        } elseif ($this->alpha_mode === self::ALP_UP_LO) {
            $code = mt_rand(0, 1) ? $this->getRandAlphabetLower() : $this->getRandAlphaUpper();
        }
        return $code;
    }

    protected function getRandAlphaUpper()
    {
        return chr(mt_rand(65, 90));
    }

    protected function getRandAlphabetLower()
    {
        return chr(mt_rand(97, 122));
    }

    protected function getRandNum()
    {
        return mt_rand(0, 9);
    }
}