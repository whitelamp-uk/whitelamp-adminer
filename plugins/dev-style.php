<?php

class DevStyle {

        private $config;

    /** Print HTML code inside <head>
    * @return bool true to link favicon.ico and adminer.css if exists
    */
    function head ( ) {
/*
  * asynchronously load shared whitelamp-adminer.cfg.js
  * make a dev database look a bit pink
*/
        require __DIR__.'/dev-style-html.php';
    }


}

