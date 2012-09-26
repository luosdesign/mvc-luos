<?php
/**
 * @author oscalber
 * @copyright 2012
 */
class google{
    
    public function buttonPlus(){
        
        $script='<g:plusone size="tall"></g:plusone><script type="text/javascript">
                  window.___gcfg = {lang: \'es\'};
                
                  (function() {
                    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
                    po.src = \'https://apis.google.com/js/plusone.js\';
                    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>';
                
          return $script;      
        
    }
    
}


?>