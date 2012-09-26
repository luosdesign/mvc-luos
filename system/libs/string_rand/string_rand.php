<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class string_rand{
    
    function getUniqueCode($length = 8){
      $code = md5(uniqid(rand(), true));
      if ($length != "") return substr($code, 0, $length);
      else return $code;
    }
    
}


?>