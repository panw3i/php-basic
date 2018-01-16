<?php
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 15/01/2018
 * Time: 09:28
 */

// -->  随机字符串范围
$string = "abcdefghigklfmnopqrstvumsxyz0123456789";

$str = "";

// -->  随机生成4个字符
for($i=0;$i<4;$i++){

    // --> 随机下标
    $pos = rand(0,35);
    // --> 字符串拼接
    $str .= $string{$pos};
}

// --> 开启 session 会话
session_start();

// --> 保存此次会话的产生的随机字符串
$_SESSION['img_number'] = $str;

// --> 图片大小80X20
$img_handle = Imagecreate(80, 36);
// --> 背景颜色（白色）
$back_color = ImageColorAllocate($img_handle, 255, 255, 255);
// --> 文本颜色（黑色）
$txt_color = ImageColorAllocate($img_handle, 0, 0, 0);

// --> 加入干扰线
for ($i = 0; $i < 3; $i++) {

    // -->  第一个参数表示绘制的位置
    $line = ImageColorAllocate($img_handle, rand(0, 255), rand(0, 255), rand(0, 255));
    Imageline($img_handle, rand(0, 15), rand(0, 15), rand(100, 150), rand(10, 50), $line);
}

// --> 加入干扰象素
for ($i = 0; $i < 200; $i++) {
    $randcolor = ImageColorallocate($img_handle, rand(0, 255), rand(0, 255), rand(0, 255));
    Imagesetpixel($img_handle, rand() % 100, rand() % 50, $randcolor);
}

// --> 填充图片背景色
Imagefill($img_handle, 0, 0, $back_color);

// --> 水平填充一行字符串
ImageString($img_handle, 5, 10, 0, $str, $txt_color);

// -->  ob_clean()清空输出缓存区
ob_clean();

// --> 生成验证码图片
header("Content-type: image/png");

$img = Imagepng($img_handle);//显示图片

