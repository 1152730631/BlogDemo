<?php
/**
 * Created by PhpStorm.
 * User: mrlifang
 * Date: 17/5/9
 * Time: 下午3:29
 */

namespace Frame\Vendor;


class Captcha
{
    //私有成员属性
    private $code;      //验证码字符串
    private $codelen;   //字符串长度
    private $width;     //图片宽度
    private $height;    //图片高度
    private $img;       //图像资源
    private $fontsize;  //文字大小
    private $fontfile;  //字体文件

    public function __construct($codelen = 4,$width=85,$height=40,$fontsize=40)
    {
        $this->codelen = $codelen;
        $this->width = $width;
        $this->height = $height;
        $this->fontsize = $fontsize;
        $this->fontfile = "";

        $this->createCode(); //生存随机码字符串
        $this->createImg();  //创建图像画布
        $this->createBg();   //填充背景色
        $this->createText(); //写入字符串
        $this->outPut();     //输出图像
    }

    /*
     * 生成随机码字符串
     */
    public function createCode(){
        $str= "";
        $arr_list = range(0,9);
        shuffle($arr_list);
        shuffle($arr_list);
        $arr_index = array_rand($arr_list,4);
        foreach($arr_index as $key => $value){
            $str .= "$arr_index[$key]";
        }
        $this->code = $str;
    }
    /*
     * 创建图像画布
     */
    public function createImg(){
        //创建画布并生存图像资源,所有操作都是基于该画布的
        $this->img = imagecreatetruecolor($this->width,$this->height);
    }
    /*
     * 创建画布填充背景色
     */
    public function createBg(){
        //分配颜色
        //$color = imagecolorallocate($this->img,mt_rand(0,127),mt_rand(0,127),mt_rand(0,127));
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        //在画布上绘制一个填充矩形
        //imagefilledrectangle($this->img,0,0,$this->width,$this->height,$color);
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);

    }
    /*
     * 写入字符串
     */
    public function createText(){
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        //分配文本颜色
        //imagettftext($this->img,$this->fontsize,0,30,50,$color,$this->fontfile,$this->code);
        imagestring($this->img, $this->fontsize, 5, 10, $this->code, $color);
        //imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
    }
    /*
     * 输出图像
     */
    public function outPut(){
        header("content-type:image/png");
        imagepng($this->img);
    }

    /*
     * 获取验证码值
     */
    public function getCode(){
        return strtolower($this->code);
    }

}