<?php

class UrlHyperlink {


/** Get options to display edit field
* @param string table name
* @param array single field from fields()
* @param string attributes to use inside the tag
* @param string
* @return string custom input field or empty string for default
*/
   /*
       When using Adminer select tool, cell values that are in good
       URL format get converted into <a>link</a>s.
       Sadly in other views this is not the case:
         * Data returned from a stored procedure
         * Data returned from arbitrary SQL
       This plug-in rectifies that oversight.
   */
/** Value printed in select table
* @param string HTML-escaped value to print
* @param string link to foreign key
* @param array single field returned from fields()
* @param array original value before applying editVal() and escaping
* @return string
*/


    function selectVal ($val,$link,$field,$original) {
        $return = ($val===null ? "<i>NULL</i>" : (preg_match("~char|binary|boolean~",$field["type"]) && !preg_match("~var~",$field["type"]) ? "<code>$val</code>" : $val));
        if (preg_match('~blob|bytea|raw|file~',($field["type"]) && !is_utf8($val))) {
            $return = "<i>" . lang('%d byte(s)', strlen($original)) . "</i>";
        }
        if (preg_match('~json~',$field["type"])) {
            $return = "<code class='jush-js'>$return</code>";
        }
//        error_log ($link);
        // extra bit
        if (!$link && (strpos(strtolower($return),'http://')===0 || strpos(strtolower($return),'https://')===0)) {
          $link = $return;
        }
        return ($link ? "<a href='" . h($link) . "'" . (is_url($link) ? target_blank() : "") . ">$return</a>" : $return);
    }

/*
    function editVal (string $val,array $field) {
        if (strpos(strtolower($val),'http://')===0 || strpos(strtolower($val),'https://')===0) {
//            error_log ($val);
        }
        return $val;
    }
*/

}

