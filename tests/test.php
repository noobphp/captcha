<?php
/**
 * Created by PhpStorm.
 * User: pxb
 * Date: 2018/9/15
 * Time: 下午9:16
 */

use \Noob\Captcha\Lib\NoobCaptchaCodeGenerator;
use \Noob\Captcha\Lib\NoobCaptchaPaint;
use \Noob\Captcha\Captcha;

ini_set('display_errors', true);

require ("../vendor/autoload.php");

//$captcha = new Captcha();
//$captcha->display();

$code_generator = new NoobCaptchaCodeGenerator(4, NoobCaptchaCodeGenerator::NUM_ALP);
$code_generator->setAlphaMode(NoobCaptchaCodeGenerator::ALP_UP_LO);

$paint = new NoobCaptchaPaint(200, 60);
$paint->setBgColor(255, 255, 255)->setFontFile('../src/font/PIXEAB__.TTF');

$captcha = new Captcha($code_generator, $paint);
$captcha->display();

file_put_contents('./test.txt', $captcha->getCode());