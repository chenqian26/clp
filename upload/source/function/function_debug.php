<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | function_debug.php 2015/05/03 15:57:33 CST chenqian26      |
  +----------------------------------------------------------------------+
 */


function dump($vars, $label = '', $return = false) {
    if (ini_get('html_errors')) {
          $content = "<pre>\n";
          if ($label != '') {
              $content .= "<strong>{$label} :</strong>\n";
           }
           $content .= htmlspecialchars(print_r($vars, true));
           $content .= "\n</pre>\n";
    } 
    else {
           $content = $label . " :\n" . print_r($vars, true);
     }
     if ($return) { return $content; }
     echo $content;
     return null;
}
?>
