<?php
/**
 * @author oscalber
 * @copyright 2012
 */
//require_once dirname(__FILE__) . '/securimage.php';
//require_once dirname(__FILE__) . '/securimageShow.php';
class captcha_helper{
    
    
    public function loadCaptcha(){
       $img='<img id="captchaImage" style="border: 1px solid #000; margin-right: 15px" src="'.BASE_URL_LIBS.'/captcha/securimageShow.php'.'?sid='.md5(uniqid()).'" alt="CAPTCHA Image" align="left">';
        
       return $img;
        
    }
    
    
    public function reloadCaptcha($title){
        $img='<a tabindex="-1" style="border-style: none;" href="javascript:void(0);" title="'.$title.'" onclick="reloadCaptcha(); this.blur(); return false"><img src="'.BASE_URL_LIBS. DS .'captcha/images/refresh.png" alt="'.$title.'" onclick="this.blur()" align="bottom" border="0"></a>';
       return $img; 
    }
    
    public function audioCaptcha(){
        $object='<object type="application/x-shockwave-flash" data="'.BASE_URL_LIBS . "captcha". DS .'/securimage_play.swf?audio_file='.BASE_URL_LIBS . "captcha". DS .'/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
    <param name="movie" value="'.BASE_URL_LIBS . "captcha". DS .'/securimage_play.swf?audio_file='.BASE_URL_LIBS . "captcha". DS .'/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
    </object>';
    return $object;
    }
    
    public function loadJsCaptcha(){
        
        $js="<script type='text/javascript'>function reloadCaptcha() {document.getElementById('captchaImage').src = '".BASE_URL_LIBS . "captcha". DS ."/securimageShow.php?sid=' + Math.random();}</script>";
        
        return $js;
    }
    
}


?>