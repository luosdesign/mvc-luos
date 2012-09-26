<?php
/**
 |-------------------------------------
 |	File facebook BASE FILE		  |
 |-------------------------------------
 |	@package libs
 |	@File facebook.php
 |  @class facebook	
 |	@version 1.0
 |	@access Dont Touch This File
 |	@copyright LuosDesign.com - 2012
 |  @definition: makes use of session variables in MVC
 **/
class facebook{
    /**
     | @function: fbLike
     | @access: public
     | @definition:create botom like to facebook 
     |          
     **/
    public function fbLike(){
        $script='<div id="fb-root"></div> <script type="text/javascript">(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, "script", "facebook-jssdk"));</script>';
        $divs='<div class="fb-like" data-send="true" data-layout="box_count"  data-width="100" data-show-faces="true"></div>';
        $final=$script.$divs;
        
        return $final;
        
    }
    /**
     | @function: shared
     | @access: public
     | @definition:create botom shared to facebook 
     |          
     **/
    public function shared($url=null,$logo=null,$description=null,$title=null){
        $script='<a  href="javascript:void(0)" onClick="javascript:popup(\'http://www.facebook.com/sharer.php?u=http://www.oscar-gomez.net/muestra_videos.php?id=1&t=1\');" title="Compartir en Facebook"><img src="'.BASE_URL.WEBFILE_IMAGES.'face.png" width="40" height="40" border="0" style="width:40px; height:40px"></a>';
        
        return $script;
    }
    
}


?>